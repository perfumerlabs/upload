<?php

namespace Upload\Controller\File;

use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;

class DownloadController extends LayoutController
{
    public function get()
    {
        $digest_prefix = $this->getContainer()->getParam('server/digest');
        $auth = $this->getContainer()->getParam('server/auth');
        $auth_salt = $this->getContainer()->getParam('server/auth_salt');
        $digest = (string) $this->f('digest');

        if ($auth === 'true') {
            $timestamp = (int) $this->f('timestamp');
            $expire = (int) $this->f('expire');
            $hash = (string) $this->f('hash');

            if (!$timestamp) {
                $this->pageNotFoundException();
            }

            if (!$expire) {
                $this->pageNotFoundException();
            }

            if (time() > $timestamp + $expire) {
                $this->pageNotFoundException();
            }

            $hash_string = hash('sha256', $auth_salt . $digest . $timestamp . $expire);

            if ($hash_string !== $hash) {
                $this->pageNotFoundException();
            }
        }

        if ($digest_prefix) {
            $digest = substr($digest, strlen($digest_prefix));
        }

        $file = FileQuery::create()->findOneByDigest($digest);

        if (!$file) {
            $this->pageNotFoundException();
        }

        $file_path = null;

        if (file_exists(FILES_DIR . $file->getPath())) {
            $file_path = $file->getPath();
        } elseif (file_exists(FILES_DIR . $file->getPath() . '.')) {
            // workaround, because upload library does not save file without extension correctly
            $file_path = $file->getPath() . '.';
        }

        if (!$file_path) {
            $this->pageNotFoundException();
        }

        $this->getExternalResponse()->headers->set('X-Accel-Redirect', '/files/' . $file_path);
        $this->getExternalResponse()->headers->set('Content-Type', $file->getContentType());
        $this->getExternalResponse()->headers->set('Content-Disposition', "filename=\"{$file->getNameWithExtension()}\"");
        $this->getExternalResponse()->headers->set('Cache-Control', 'public');
    }
}