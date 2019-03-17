<?php

namespace Upload\Controller;

use Perfumer\Framework\Controller\ViewController;
use Perfumer\Framework\Router\Http\FastRouteRouterControllerHelpers;
use Upload\Service\View\StatusViewControllerHelpers;

class LayoutController extends ViewController
{
    use StatusViewControllerHelpers;
    use FastRouteRouterControllerHelpers;
}
