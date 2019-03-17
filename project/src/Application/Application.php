<?php

namespace Upload\Application;

use Perfumer\Package\Framework\Bundle\ConsoleBundle;
use Perfumer\Package\Framework\Bundle\HttpBundle;
use Upload\Bundle\SharedBundle;
use Upload\Bundle\UploadBundle;

class Application extends \Perfumer\Framework\Application\Application
{
    protected function before()
    {
        date_default_timezone_set('Asia/Almaty');

        define('ROOT_DIR', __DIR__ . '/../../');
        define('TMP_DIR', ROOT_DIR . 'tmp/');
        define('VENDOR_DIR', ROOT_DIR . 'vendor/');
        define('WEB_DIR', ROOT_DIR . 'web/');
        define('FILES_DIR', ROOT_DIR . 'files/');
        define('THUMBNAIL_DIR', WEB_DIR . 'thumbnail/');
    }

    protected function after()
    {
        $this->container->get('propel.service_container');
    }

    protected function configure()
    {
        $this->addBundle(new HttpBundle(),   self::HTTP);
        $this->addBundle(new ConsoleBundle(),self::CLI);
        $this->addBundle(new SharedBundle());
        $this->addBundle(new UploadBundle(), self::HTTP);
    }
}
