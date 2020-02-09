<?php

namespace Upload\Module;

use Perfumer\Framework\Controller\Module;

class ControllerModule extends Module
{
    public $name = 'upload';

    public $router = 'upload.router';

    public $request = 'upload.request';

    public $components = [
        'view' => 'view.status'
    ];
}
