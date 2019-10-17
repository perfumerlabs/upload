<?php

namespace Upload\Controller\File;

use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;

class InfoController extends LayoutController
{
    public function get()
    {
        $digest_prefix = $this->getContainer()->getParam('server/digest');

        $digest = (string) $this->f('digest');

        if ($digest_prefix) {
            $digest = substr($digest, strlen($digest_prefix));
        }

        $file = FileQuery::create()->findOneByDigest($digest);

        if (!$file || !file_exists(FILES_DIR . $file->getPath())) {
            $this->pageNotFoundException();
        }

        $this->setFile($file);
    }
}