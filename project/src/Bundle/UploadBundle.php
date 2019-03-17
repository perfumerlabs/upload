<?php

namespace Upload\Bundle;

use Perfumer\Component\Container\AbstractBundle;

class UploadBundle extends AbstractBundle
{
    public function getName()
    {
        return 'upload';
    }

    public function getDefinitionFiles()
    {
        return [
            __DIR__ . '/../Resource/config/services_http.php'
        ];
    }

    public function getAliases()
    {
        return [
            'router' => 'upload.router',
            'request' => 'upload.request',
            'view' => 'view.status'
        ];
    }
}
