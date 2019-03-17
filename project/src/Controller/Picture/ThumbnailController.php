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

        $digest = substr((string) $this->f('digest'), strlen($digest_prefix));

        /** @var Picture $picture */
        $picture = $this->s('picture');
        $width  = (int)    $this->f('w');
        $height = (int)    $this->f('h');
        $mode   = (string) $this->f('m');

        $width = min(1000, $width);
        $width = max(0, $width) ?: 1000;

        $height = min(1000, $height);
        $height = max(0, $height) ?: 1000;

        if (!in_array($mode, ['r', 'c'])) {
            $mode = 'r';
        }

        $file = FileQuery::create()->findOneByDigest($digest);

        if (!$file || !file_exists(FILES_DIR . $file->getPath()) || !$file->isImage()) {
            $this->pageNotFoundException();
        }

        try {
            $thumb_path = $picture->thumbnail($file, $width, $height, $mode);

            $this->getExternalResponse()->headers->set('X-Accel-Redirect', $thumb_path);
            $this->getExternalResponse()->headers->set('Content-Type', 'image/jpeg');
            $this->getExternalResponse()->headers->set('Cache-Control', 'public');
        } catch (\Exception $e) {
            $this->pageNotFoundException();
        }
    }
}
