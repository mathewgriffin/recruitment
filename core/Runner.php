<?php

namespace Core;

use Core\Router\Router;
use FastRoute;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class Runner
 *
 * @package Core
 */
class Runner
{
    /**
     * @throws \Exception
     */
    public static function run()
    {
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/customers', 'Customer:getAll');
            $r->addRoute('GET', '/customer/{id:\d+}', 'Customer:get');
            $r->addRoute('GET', '/customer/create', 'Customer:create');
            $r->addRoute('POST', '/customer/create', 'Customer:save');
            $r->addRoute('GET', '/bookings/customer/{id:\d+}', 'Booking:getByCustomerId');
            $r->addRoute('GET', '/bookings', 'Booking:getAll');
            $r->addRoute('GET', '/booking/create', 'Booking:create');
            $r->addRoute('GET', '/', 'Index:index');
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                echo Router::dispatch('Exception', 'exception404',  []);
                break;

            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                echo Router::dispatch('Exception', 'exception405',  []);
                break;

            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                list($class, $method) = explode(":", $handler, 2);

                echo Router::dispatch($class, $method, $vars);
                break;
        }
    }
}
