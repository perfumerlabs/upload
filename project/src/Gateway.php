<?php

namespace Upload;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addModule('upload', null, null, 'http');
    }
}
