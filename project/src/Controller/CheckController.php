<?php

namespace Upload\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Upload\Model\FileQuery;

class CheckController extends LayoutController
{
    public function post()
    {
        $prefix = $this->getContainer()->getParam('server/digest');

        $digests = array_map('strval', $this->f('digests'));

        $content = array_map(function($item) {
            return false;
        }, array_flip($digests));

        $digests = array_map(function ($digest) {
            return substr($digest, 5);
        }, $digests);

        $files = FileQuery::create()
            ->filterByDigest($digests, Criteria::IN)
            ->select('digest')
            ->find()
            ->getData();

        $files = array_flip($files);

        foreach ($digests as $digest) {
            $content[$prefix . $digest] = isset($files[$digest]);
        }

        $this->setContent($content);
    }
}
