<?php

namespace Upload\Controller\Picture;

use Imagine\Exception\RuntimeException;
use Imagine\Imagick\Image;
use Imagine\Imagick\Imagine;
use Upload\Controller\LayoutController;
use Upload\File as FileUpload;
use Upload\Model\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;
use Imagick;

class UploadController extends LayoutController
{
    public function post()
    {
        $target_dir = date('Y/m/d/H/i');
        @mkdir(FILES_DIR . $target_dir, 0777, true);

        $storage = new FileSystem(FILES_DIR . $target_dir);
        $upload = new FileUpload('file', $storage);

        $upload->addValidations([
            new Mimetype(['image/jpeg', 'image/png', 'image/gif', 'image/svg']),
            new Size($this->getContainer()->getParam('file/max_size')),
        ]);

        // This is temporary solution for UTF-8 filename bug
        $name = explode('.', $_FILES['file']['name']);
        $name = reset($name);

        $file = new File();
        $file->setName($name);
        $file->setExtension($upload->getExtension() ?: 'jpg');
        $file->setDir($target_dir);
        $file->setIsImage(true);
        $file->setContentType($upload->getMimetype());
        $file->generateDigest($this->getContainer()->getParam('file/digest_length'));

        try {
            if ($file->save()) {
                $file_name = $file->getDigest();

                if ($file->getExtension()) {
                    $file_name .= '.' . $file->getExtension();
                }

                $upload->upload($file_name);

                /** @var Imagine $imagick */
                $imagick = $this->s('imagick');

                if ($file->getExtension() !== 'svg') {
                    // проверяем изображение ли это
                    $image = $imagick->open(FILES_DIR . $file->getPath());

                    $this->autoRotateImage($image);
                    $image->save();
                }

                $this->setFile($file);
            } else {
                $this->setErrorMessage('Unable to save the file');
            }
        } catch (RuntimeException $e) {
            // файл не изображение, выпиливаем из хранилища
            @unlink(FILES_DIR . $file->getPath());
            $file->delete();
            $this->setErrorMessageAndExit('Invalid image');
        } catch (\Exception $e) {
            $file->delete();
            $this->setErrorMessageAndExit($upload->getErrors()[0]);
        }
    }

    private function autoRotateImage(Image $image)
    {
        $imagick = $image->getImagick();

        switch ($imagick->getImageOrientation()) {
            case Imagick::ORIENTATION_TOPLEFT:
                break;
            case Imagick::ORIENTATION_TOPRIGHT:
                $image->flipHorizontally();
                break;
            case Imagick::ORIENTATION_BOTTOMRIGHT:
                $image->rotate(180);
                break;
            case Imagick::ORIENTATION_BOTTOMLEFT:
                $image->flipHorizontally();
                $image->rotate(180);
                break;
            case Imagick::ORIENTATION_LEFTTOP:
                $image->flipHorizontally();
                $image->rotate(-90);
                break;
            case Imagick::ORIENTATION_RIGHTTOP:
                $image->rotate(90);
                break;
            case Imagick::ORIENTATION_RIGHTBOTTOM:
                $image->flipHorizontally();
                $image->rotate(90);
                break;
            case Imagick::ORIENTATION_LEFTBOTTOM:
                $image->rotate(-90);
                break;
            default: // Invalid orientation
                break;
        }

        $imagick->setImageOrientation(Imagick::ORIENTATION_TOPLEFT);

        return $image;
    }
}
