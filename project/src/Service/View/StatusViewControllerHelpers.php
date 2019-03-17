<?php

namespace Upload\Service\View;

use Perfumer\Framework\Controller\Exception\ExitActionException;
use Upload\Model\File;

trait StatusViewControllerHelpers
{
    /**
     * @return bool
     */
    protected function getStatus()
    {
        return $this->getView()->getStatus();
    }

    /**
     * @param bool $status
     */
    protected function setStatus($status)
    {
        $this->getView()->setStatus($status);
    }

    /**
     * @param bool $status
     * @throws ExitActionException
     */
    protected function setStatusAndExit($status)
    {
        $this->getView()->setStatus($status);

        throw new ExitActionException();
    }

    /**
     * @return string
     */
    protected function getMessage()
    {
        return $this->getView()->getMessage();
    }

    /**
     * @param string $message
     */
    protected function setErrorMessage($message)
    {
        $this->getView()->setErrorMessage($message);
    }

    /**
     * @param string $message
     * @throws ExitActionException
     */
    protected function setErrorMessageAndExit($message)
    {
        $this->getView()->setErrorMessage($message);

        throw new ExitActionException;
    }

    /**
     * @param string $message
     */
    protected function setSuccessMessage($message)
    {
        $this->getView()->setSuccessMessage($message);
    }

    /**
     * @param string $message
     * @throws ExitActionException
     */
    protected function setSuccessMessageAndExit($message)
    {
        $this->getView()->setSuccessMessage($message);

        throw new ExitActionException;
    }

    /**
     * @return bool
     */
    protected function hasMessage()
    {
        return $this->getView()->hasMessage();
    }

    /**
     * @return mixed
     */
    protected function getContent()
    {
        return $this->getView()->getContent();
    }

    /**
     * @param mixed $content
     */
    protected function setContent($content)
    {
        $this->getView()->setContent($content);
    }

    /**
     * @param mixed $content
     * @throws ExitActionException
     */
    protected function setContentAndExit($content)
    {
        $this->getView()->setContent($content);

        throw new ExitActionException();
    }

    /**
     * @return bool
     */
    protected function hasContent()
    {
        return $this->getView()->hasContent();
    }

    /**
     * @return string
     */
    protected function getDigest()
    {
        return $this->getView()->getDigest();
    }

    /**
     * @param string $digest
     */
    protected function setDigest($digest)
    {
        $this->getView()->setDigest($digest);
    }

    /**
     * @param string $digest
     * @throws ExitActionException
     */
    protected function setDigestAndExit($digest)
    {
        $this->getView()->setDigest($digest);

        throw new ExitActionException();
    }

    /**
     * @return bool
     */
    protected function hasDigest()
    {
        return $this->getView()->hasDigest();
    }

    /**
     * @return string
     */
    protected function getThumbnail()
    {
        return $this->getView()->getThumbnail();
    }

    /**
     * @param string $thumbnail
     */
    protected function setThumbnail($thumbnail)
    {
        $this->getView()->setThumbnail($thumbnail);
    }

    /**
     * @param string $thumbnail
     * @throws ExitActionException
     */
    protected function setThumbnailAndExit($thumbnail)
    {
        $this->getView()->setThumbnail($thumbnail);

        throw new ExitActionException();
    }

    /**
     * @return bool
     */
    protected function hasThumbnail()
    {
        return $this->getView()->hasThumbnail();
    }

    /**
     * @param File $file
     */
    protected function setFile(File $file)
    {
        $this->getView()->setFile($file);
    }

    /**
     * @param File $file
     * @throws ExitActionException
     */
    protected function setFileAndExit($file)
    {
        $this->getView()->setFile($file);

        throw new ExitActionException();
    }
}
