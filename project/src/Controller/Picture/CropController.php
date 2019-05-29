<?php

namespace Upload\Controller\Picture;

use Propel\Runtime\Propel;
use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;
use Upload\Model\Map\FileTableMap;
use Upload\Service\Picture;

class CropController extends LayoutController
{
    public function post()
    {
        list($crop_x, $crop_y, $width, $height, $digest) = array_values($this->f([
            'x', 'y', 'w', 'h', 'digest',
        ]));

        $digest_prefix = $this->getContainer()->getParam('server/digest');

        if ($digest_prefix) {
            $digest = substr($digest, strlen($digest_prefix));
        }

        /** @var Picture $picture */
        $picture = $this->s('picture');

        if (!$file = FileQuery::create()->findOneByDigest($digest)) {
            $this->setErrorMessageAndExit("file not found| {$digest}");
        }

        $cropped = $picture->crop($file, $crop_x, $crop_y, $width, $height);

        $connection = Propel::getWriteConnection(FileTableMap::DATABASE_NAME);
        $connection->beginTransaction();

        try {
            $cropped->generateDigest($this->getContainer()->getParam('file/digest_length'));
            $cropped->save();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            $this->setErrorMessageAndExit('server error');
        }

        $this->setFile($cropped);
    }
}
