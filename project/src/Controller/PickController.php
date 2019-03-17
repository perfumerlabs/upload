<?php

namespace Upload\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Upload\Model\FileQuery;
use Upload\Model\Map\FileTableMap;

class PickController extends LayoutController
{
    public function post()
    {
        $now = new \DateTime();

        $prefix = $this->getContainer()->getParam('server/digest');
        $digests = array_map('strval', $this->f('digests'));

        $content = array_map(function($item) {
            return false;
        }, array_flip($digests));

        foreach ($digests as &$digest) {
            $digest = substr($digest, 5);
        }

        $files = FileQuery::create()
            ->create()
            ->filterByDigest($digests, Criteria::IN)
            ->find();

        $connection = Propel::getWriteConnection(FileTableMap::DATABASE_NAME);
        $connection->beginTransaction();

        try {
            foreach ($files as $file) {
                $file->setPickedAt($now);
                $file->save();

                $content[$prefix . $file->getDigest()] = true;
            }

            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            $this->setErrorMessageAndExit('server error');
        }

        $this->setContent($content);
    }
}
