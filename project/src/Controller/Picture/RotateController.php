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
        $degree  = (int) $this->f('degree');

        if (!$degree) {
            $degree  = (int) $this->f('d');
        }

        $digest = substr((string) $this->f('digest'), 5);

        if ($degree % 90 !== 0) {
            $this->setErrorMessageAndExit('Parameter "d" must be divisible by 90.');
        }

        if (!$file = FileQuery::create()->findOneByDigest($digest)) {
            $this->setErrorMessageAndExit('file not found');
        }

        $rotated = $picture->rotate($file, $degree);

        $connection = Propel::getWriteConnection(FileTableMap::DATABASE_NAME);
        $connection->beginTransaction();

        try {
            $rotated->generateDigest($this->getContainer()->getParam('file/digest_length'));
            $rotated->save();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            $this->setErrorMessageAndExit('server error');
        }

        $this->setFile($rotated);
    }
}
