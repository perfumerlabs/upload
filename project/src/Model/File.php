<?php

namespace Upload\Model;

use Perfumer\Helper\Text;
use Propel\Runtime\Connection\ConnectionInterface;
use Upload\Model\Base\File as BaseFile;

/**
 * Skeleton subclass for representing a row from the 'file' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class File extends BaseFile
{
    /**
     * @return string
     */
    public function getNameWithExtension()
    {
        $filename = $this->getName() ?: $this->getDigest();

        if ($this->getExtension()) {
            $filename .= '.' . $this->getExtension();
        }

        return $filename;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        $path = $this->getDir() . '/' . $this->getDigest();

        if ($this->getExtension()) {
            $path .= '.' . $this->getExtension();
        }

        return $path;
    }

    public function generateDigest($length = 10)
    {
        do {
            $digest = Text::generateString($length);

            $count = FileQuery::create()
                ->filterByDigest($digest)
                ->count();
        } while ($count > 0);

        $this->setDigest($digest);
    }
}
