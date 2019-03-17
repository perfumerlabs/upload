<?php

namespace Upload\Controller\File;

use Upload\Controller\LayoutController;
use Upload\File as FileUpload;
use Upload\Model\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Size;

class UploadController extends LayoutController
{
    public function post()
    {
        $target_dir = date('Y/m/d/H/i');
        @mkdir(FILES_DIR . $target_dir, 0777, true);

        $storage = new FileSystem(FILES_DIR . $target_dir);
        $upload = new FileUpload('file', $storage);

        $upload->addValidations([
            new Size($this->getContainer()->getParam('file/max_size')),
        ]);

        // This is temporary solution for UTF-8 filename bug
        $name = explode('.', $_FILES['file']['name']);
        $name = reset($name);

        $file = new File();
        $file->setName($name);
        $file->setExtension($upload->getExtension());
        $file->setDir($target_dir);
        $file->setContentType($upload->getMimetype());
        $file->setIsImage(false);
        $file->generateDigest($this->getContainer()->getParam('file/digest_length'));

        try {
            if ($file->save()) {
                $upload->upload($file->getDigest() . '.' . $file->getExtension());

                $this->setFile($file);
            } else {
                $this->setErrorMessage('Unable to save the file');
            }
        } catch (\Exception $e) {
            $file->delete();
            $this->setErrorMessageAndExit($upload->getErrors()[0]);
        }
    }
}
