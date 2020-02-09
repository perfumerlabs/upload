<?php

namespace Upload;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addBundle('upload', 'upload', null, 'http');
    }
}
