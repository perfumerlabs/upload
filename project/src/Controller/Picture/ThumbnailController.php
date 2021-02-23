<?php

namespace Upload\Controller\Picture;

use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;
use Upload\Service\Picture;

class ThumbnailController extends LayoutController
{
    public function get()
    {
        $digest_prefix = $this->getContainer()->getParam('server/digest');
        $max_dimension = $this->getContainer()->getParam('file/max_dimension');

        $digest = (string) $this->f('digest');

        if ($digest_prefix) {
            $digest = substr($digest, strlen($digest_prefix));
        }

        /** @var Picture $picture */
        $picture = $this->s('picture');
        $width  = (int)    $this->f('w');
        $height = (int)    $this->f('h');
        $mode   = (string) $this->f('m');

        $width = min($max_dimension, $width);
        $width = max(0, $width) ?: $max_dimension;

        $height = min($max_dimension, $height);
        $height = max(0, $height) ?: $max_dimension;

        if (!in_array($mode, ['r', 'c'])) {
            $mode = 'r';
        }

        $file = FileQuery::create()->findOneByDigest($digest);

        if (!$file || (!file_exists(FILES_DIR . $file->getPath()) && $file->getPath()) || $file->isImage() === false) {
            $this->pageNotFoundException();
        }

        try {
            $thumb_path = $picture->thumbnail($file, $width, $height, $mode);

            $content_type = 'image/jpeg';

            if ($file->getExtension() === 'svg') {
                $content_type = 'image/svg+xml';
            }

            $this->getExternalResponse()->headers->set('X-Accel-Redirect', $thumb_path);
            $this->getExternalResponse()->headers->set('Content-Type', $content_type);
            $this->getExternalResponse()->headers->set('Cache-Control', 'public');
        } catch (\Exception $e) {
            $this->pageNotFoundException();
        }
    }
}
