<?php

namespace Upload\Service;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;
use Upload\Model\File;

class Picture implements \Upload\Contract\Picture
{
    /**
     * @var Imagine
     */
    private $imagick;

    public function __construct(Imagine $imagick)
    {
        $this->imagick = $imagick;
    }

    public function rotate(File $file, $degree)
    {
        $degree = (int) $degree;

        if ($degree % 360 === 0) {
            return $file;
        }

        $rotated = new File();

        $source_id = $file->getSourceId() ?: $file->getId();
        $rotated->setSourceId($source_id);

        $transforms = explode('/', $file->getTransform());
        $transforms[] = "rotate.{$degree}";

        $rotated->setTransform(trim(join('/', $transforms), '/'));

        return $rotated;
    }

    public function crop(File $file, $x, $y, $w, $h)
    {
        $x = $x < 0 ? 0 : (int) $x;
        $y = $y < 0 ? 0 : (int) $y;
        $w = $w < 0 ? 0 : (int) $w;
        $h = $h < 0 ? 0 : (int) $h;

        $cropped = new File();

        $source_id = $file->getSourceId() ?: $file->getId();
        $cropped->setSourceId($source_id);

        $transforms = explode('/', (string) $file->getTransform());
        $transforms[] = "crop.{$x}.{$y}.{$w}.{$h}";

        $cropped->setTransform(trim(join('/', $transforms), '/'));

        return $cropped;
    }

    public function original(File $file)
    {
        $source = $file->getSourceId() ? $file->getSource() : $file;

        $source_path      = FILES_DIR . $source->getPath();
        $picture_dir      = 'thumbnail/v1/' . implode('/', str_split($file->getDigest(), 2));
        $picture_web_path = "{$picture_dir}/original.{$source->getExtension()}";
        $picture_path     = WEB_DIR . $picture_web_path;

        if (file_exists($picture_path)) {
            return '/' . $picture_web_path;
        }

        @mkdir(WEB_DIR . $picture_dir, 0777, true);
        copy($source_path, $picture_path);

        return '/' . $picture_web_path;
    }

    public function thumbnail(File $file, $w, $h, $m = 'r')
    {
        $w = (int) $w;
        $h = (int) $h;

        $source = $file->getSourceId() ? $file->getSource() : $file;

        $source_path        = FILES_DIR . $source->getPath();
        $thumbnail_mode     = ($m == 'r') ? ImageInterface::THUMBNAIL_INSET : ImageInterface::THUMBNAIL_OUTBOUND;
        $thumbnail_dir      = 'thumbnail/v1/' . implode('/', str_split($file->getDigest(), 2));
        $thumbnail_web_path = "{$thumbnail_dir}/{$m}.{$w}.{$h}.jpg";
        $thumbnail_path     = WEB_DIR . $thumbnail_web_path;

        if (file_exists($thumbnail_path)) {
            return '/' . $thumbnail_web_path;
        }

        $size = getimagesize($source_path);

        if ($source->getCompressedAt() === null) {
            if ($size[0] > 1000 || $size[1] > 1000) {
                $compressed = $this->imagick
                    ->open($source_path)
                    ->thumbnail(new Box(1000, 1000), ImageInterface::THUMBNAIL_INSET);

                @unlink($source_path);

                $compressed->save($source_path, [
                    'jpeg_quality' => 100,
                ]);

                unset($compressed);
            }

            $source->setCompressedAt(new \DateTime());
            $source->save();
        }

        $thumbnail = $this->imagick->open($source_path);

        if ($file->getTransform()) {
            foreach (explode('/', $file->getTransform()) as $transform) {
                $transform_arguments = explode('.', $transform);
                list($action) = $transform_arguments;

                switch ($action) {
                    case 'rotate':
                        list(, $degree) = $transform_arguments;
                        $thumbnail = $this->doRotate($thumbnail, $degree);
                        break;
                    case 'crop':
                        list(, $crop_x, $crop_y, $crop_width, $crop_height) = $transform_arguments;
                        $thumbnail = $this->doCrop($thumbnail, $crop_x, $crop_y, $crop_width, $crop_height);
                        break;
                }
            }
        }

        @mkdir(WEB_DIR . $thumbnail_dir, 0777, true);

        $thumbnail
            ->thumbnail(new Box($w, $h), $thumbnail_mode)
            ->save($thumbnail_path, [
                'jpeg_quality' => 100,
            ]);

        return '/' . $thumbnail_web_path;
    }

    /**
     * @param ImageInterface $image
     * @param int            $degree
     * @return ImageInterface
     */
    private function doRotate($image, $degree)
    {
        return $image->rotate($degree);
    }

    /**
     * @param ImageInterface $image
     * @param int            $x
     * @param int            $y
     * @param int            $w
     * @param int            $h
     * @return ImageInterface
     */
    private function doCrop($image, $x, $y, $w, $h)
    {
        $point = new Point($x, $y);
        $box   = new Box($w, $h);
        
        return $image->crop($point, $box);
    }
}
