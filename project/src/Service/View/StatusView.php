<?php

namespace Upload\Service\View;

use Perfumer\Framework\View\Exception\ViewException;
use Perfumer\Framework\View\SerializeView;
use Upload\Model\File;

class StatusView extends SerializeView
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $digest_prefix;

    /**
     * StatusView constructor.
     *
     * @param string $host
     * @param string $digest_prefix
     */
    public function __construct($host, $digest_prefix)
    {
        parent::__construct('json');

        $this->host = $host;
        $this->digest_prefix = $digest_prefix;

        $this->addVars([
            'status' => true,
            'message' => null,
            'digest' => null,
            'thumbnail' => null,
            'content' => null
        ]);
    }

    public function render()
    {
        if ($this->getMessage() === null) {
            $this->deleteVar('message');
        }

        if ($this->getDigest() === null) {
            $this->deleteVar('digest');
        }

        if ($this->getThumbnail() === null) {
            $this->deleteVar('thumbnail');
        }

        if ($this->getContent() === null) {
            $this->deleteVar('content');
        }

        return parent::render();
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->getVar('status');
    }

    /**
     * @param bool $status
     */
    public function setStatus($status)
    {
        $this->addVar('status', (bool) $status);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->getVar('message');
    }

    /**
     * @param string $message
     */
    public function setErrorMessage($message)
    {
        $this->addVars([
            'status' => false,
            'message' => $message
        ]);
    }

    /**
     * @return string $message
     */
    public function setSuccessMessage($message)
    {
        $this->addVars([
            'status' => true,
            'message' => $message
        ]);
    }

    /**
     * @return bool
     */
    public function hasMessage()
    {
        return $this->hasVar('message');
    }

    /**
     * @return string
     */
    public function getDigest()
    {
        return $this->getVar('digest');
    }

    /**
     * @param string $digest
     * @throws ViewException
     */
    public function setDigest($digest)
    {
        throw new ViewException('Method "setDigest" disabled, use "setFile" instead.');
    }

    /**
     * @return bool
     */
    public function hasDigest()
    {
        return $this->hasVar('digest');
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->getVar('thumbnail');
    }

    /**
     * @param string $thumbnail
     * @throws ViewException
     */
    public function setThumbnail($thumbnail)
    {
        throw new ViewException('Method "setThumbnail" disabled, use "setFile" instead.');
    }

    /**
     * @return bool
     */
    public function hasThumbnail()
    {
        return $this->hasVar('thumbnail');
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->getVar('content');
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->addVar('content', $content);
    }

    /**
     * @return bool
     */
    public function hasContent()
    {
        return $this->hasVar('content');
    }

    /**
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->addVar('digest', $this->digest_prefix . $file->getDigest());
        $this->addVar('download', $this->host . '/file/' . $this->digest_prefix . $file->getDigest());

        if ($file->isImage()) {
            $this->addVar('thumbnail', $this->host . '/image/' . $this->digest_prefix . $file->getDigest());
        }
    }
}
