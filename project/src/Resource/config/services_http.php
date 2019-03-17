<?php

return [
    'fast_router' => [
        'shared' => true,
        'init' => function(\Perfumer\Component\Container\Container $container) {
            return \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
                $r->addRoute('GET', '/file/{digest}', 'file/download.get');
                $r->addRoute('POST', '/file', 'file/upload.post');
                $r->addRoute('GET', '/image/{digest}', 'picture/thumbnail.get');
                $r->addRoute('POST', '/image', 'picture/upload.post');

                // Below routes are legacy
                $r->addRoute('POST', '/picture/upload', 'picture/upload.post');
                $r->addRoute('POST', '/picture/crop/{digest}', 'picture/crop.post');
                $r->addRoute('POST', '/picture/rotate/{digest}', 'picture/rotate.post');
                $r->addRoute('GET', '/picture/thumbnail/{digest}', 'picture/thumbnail.get');
                $r->addRoute('GET', '/picture/original/{digest}', 'picture/original.get');
                $r->addRoute('POST', '/check', 'check.post');
                $r->addRoute('POST', '/pick', 'pick.post');
            });
        }
    ],

    'upload.router' => [
        'shared' => true,
        'class' => 'Perfumer\\Framework\\Router\\Http\\FastRouteRouter',
        'arguments' => ['#gateway.http', '#fast_router', [
            'data_type' => 'json'
        ]]
    ],

    'upload.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Upload\\Controller',
            'suffix' => 'Controller'
        ]]
    ]
];
