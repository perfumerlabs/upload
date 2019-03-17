<?php

namespace Upload\Controller\Picture;

use Upload\Controller\LayoutController;
use Upload\Model\FileQuery;
use Upload\Service\Picture;

class OriginalController extends LayoutController
{
    public function get()
    {
        /** @var Picture $picture */
        $picture = $this->s('picture');
        $digest = substr((string) $this->f('digest'), 5);

        if (!$file = FileQuery::create()->findOneByDigest($digest)) {
            if (!$digest = $this->getStubDigest()) {
                $this->pageNotFoundException();
            }
            if (!$file = FileQuery::create()->findOneByDigest($digest)) {
                $this->pageNotFoundException();
            }
        }

        try {
            $thumb_path = $picture->original($file);

            $this->getExternalResponse()->headers->set('X-Accel-Redirect', $thumb_path);
            $this->getExternalResponse()->headers->set('Content-Type', 'image/jpeg');
        } catch (\Exception $e) {
            $this->pageNotFoundException();
        }
    }

    private function getStubDigest()
    {
        $digests = (array) $this->getContainer()->getParam('stub/digests');

        $digest_index = array_rand($digests);

        return $digests ? $digests[$digest_index] : null;
    }
}
