<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\Base;

use Dravencms\Model\Structure\Repository\MenuRepository;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Salamek\Cms\SlugRouter;

/**
 * Class RouteFactory
 * @package Salamek\Cms
 */
class RouterFactory
{
    /** @var array */
    private $routeFactories = [];

    /**
     * @param IRouterFactory $routeFactory
     */
    public function addRouteFactory(IRouterFactory $routeFactory)
    {
        $this->routeFactories[] = $routeFactory;
    }

    /**
     * @return \Nette\Application\IRouter
     */
    public function createRouter()
    {
        $router = new RouteList();
        foreach ($this->routeFactories AS $routeFactory) {
            $router[] = $routeFactory->createRouter();
        }

        return $router;
    }
}