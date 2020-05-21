<?php

namespace Upload;

use Perfumer\Package\Framework\Module\ConsoleModule;
use Perfumer\Package\Framework\Module\HttpModule;
use Upload\Module\ControllerModule;

class Application extends \Perfumer\Framework\Application\Application
{
    protected function configure(): void
    {
        $this->addDefinitions(__DIR__ . '/../vendor/perfumer/framework/src/Package/Framework/Resource/config/services.php');
        $this->addResources(__DIR__ . '/../vendor/perfumer/framework/src/Package/Framework/Resource/config/resources.php');

        $this->addDefinitions(__DIR__ . '/Resource/config/services_shared.php');
        $this->addDefinitions(__DIR__ . '/Resource/config/services_http.php', 'http');

        $this->addResources(__DIR__ . '/Resource/config/resources_shared.php');

        $this->addModule(new HttpModule(),       'http');
        $this->addModule(new ControllerModule(), 'http');
        $this->addModule(new ConsoleModule(),    'cli');
    }

    protected function before(): void
    {
        date_default_timezone_set('UTC');

        define('ROOT_DIR', __DIR__ . '/../');
        define('TMP_DIR', ROOT_DIR . 'tmp/');
        define('VENDOR_DIR', ROOT_DIR . 'vendor/');
        define('WEB_DIR', ROOT_DIR . 'web/');
        define('FILES_DIR', ROOT_DIR . 'files/');
        define('THUMBNAIL_DIR', WEB_DIR . 'thumbnail/');
    }

    protected function after(): void
    {
        $this->container->get('propel.service_container');
    }
}
