<?php

namespace Upload\Controller\File;

use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;

class DownloadController extends LayoutController
{
    public function get()
    {
        $digest_prefix = $this->getContainer()->getParam('server/digest');

        $digest = substr((string) $this->f('digest'), strlen($digest_prefix));

        $file = FileQuery::create()->findOneByDigest($digest);

        if (!$file || !file_exists(FILES_DIR . $file->getPath())) {
            $this->pageNotFoundException();
        }

        $this->getExternalResponse()->headers->set('X-Accel-Redirect', '/files/' . $file->getPath());
        $this->getExternalResponse()->headers->set('Content-Type', $file->getContentType());
        $this->getExternalResponse()->headers->set('Content-Disposition', "filename=\"{$file->getNameWithExtension()}\"");
        $this->getExternalResponse()->headers->set('Cache-Control', 'public');
    }
}