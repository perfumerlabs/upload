<?php

namespace Upload\Controller\Picture;

use Propel\Runtime\Propel;
use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;
use Upload\Model\Map\FileTableMap;
use Upload\Service\Picture;

class RotateController extends LayoutController
{
    public function post()
    {
        /** @var Picture $picture */
        $picture = $this->s('picture');
        $degree  = $this->f('degree');
        $digest = substr((string) $this->f('digest'), 5);

        if (!$file = FileQuery::create()->findOneByDigest($digest)) {
            $this->setErrorMessageAndExit('file not found');
        }

        $rotated = $picture->rotate($file, $degree);

        $connection = Propel::getWriteConnection(FileTableMap::DATABASE_NAME);
        $connection->beginTransaction();

        try {
            $rotated->save();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            $this->setErrorMessageAndExit('server error');
        }

        $this->setFile($rotated);
    }
}
