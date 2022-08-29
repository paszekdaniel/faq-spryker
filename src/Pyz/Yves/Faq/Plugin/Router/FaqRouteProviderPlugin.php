<?php

namespace Pyz\Yves\Faq\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class FaqRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    protected const ROUTE_DAQ_INDEX = 'faq-index';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addFaqIndexRoute($routeCollection);
        return $routeCollection;
    }
    protected function addFaqIndexRoute(RouteCollection $routeCollection): RouteCollection {
        $route = $this->buildRoute('/faq', 'Faq', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_DAQ_INDEX, $route);
        return $routeCollection;
    }
}
