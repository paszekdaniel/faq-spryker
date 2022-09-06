<?php

namespace Pyz\Yves\Faq\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;
use Symfony\Component\HttpKernel\DataCollector\RouterDataCollector;

class FaqRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    protected const ROUTE_FAQ_INDEX = 'faq-index';
    protected const ROUTE_FAQ_SHOW = 'faq-show';
    protected const ROUTE_VOTE_UP_INDEX = 'faq-vote-up';
    protected const ROUTE_VOTE_DOWN_INDEX = 'faq-vote-down';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addFaqIndexRoute($routeCollection);
        $routeCollection = $this->addFaqVotesRoute($routeCollection);
        $routeCollection = $this->addShowFaqRoute($routeCollection);
        return $routeCollection;
    }
    protected function addFaqIndexRoute(RouteCollection $routeCollection): RouteCollection {
        $route = $this->buildRoute('/faq', 'Faq', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_FAQ_INDEX, $route);
        return $routeCollection;
    }
    protected function addFaqVotesRoute(RouteCollection $routeCollection): RouteCollection {
        $route1 = $this->buildRoute('/faq/vote-up', 'Faq', 'Votes', 'voteUpAction');
        $routeCollection->add(static::ROUTE_VOTE_UP_INDEX, $route1);
        $route2 = $this->buildRoute('/faq/vote-down', 'Faq', 'Votes', 'voteDownAction');
        $routeCollection->add(static::ROUTE_VOTE_DOWN_INDEX, $route2);
        return $routeCollection;
    }
    protected function addShowFaqRoute(RouteCollection $collection): RouteCollection {
        $route = $this->buildRoute('/faqs/{id}', 'Faq', 'Show', 'indexAction');
        $route = $route->setMethods(['GET']);
        $collection->add(static::ROUTE_FAQ_SHOW, $route);
        return  $collection;
    }
}
