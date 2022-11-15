<?php

use Framework\Services\Http\Requests\Request;
use Framework\Services\Http\Response\HttpResponse;
use Framework\Services\Http\Routing\Route;
use Framework\Services\Http\Routing\Router;

class Controller
{
    protected static function header()
    {
        echo <<<HTML
        <h1><a href="/">Web tests</a></h1>
        HTML;
    }

    public static function root()
    {
        static::header();
        echo <<<HTML
        <ul>
            <li><a href="/arg/val1/val2">Test uri with args as its part</a></li>
            <li><a href="/json">Test JSON response</a></li>
            <li><a href="/html">Test HTML response</a></li>
        </ul>
        HTML;
    }

    public static function wArg()
    {
        global $route;

        static::header();
        echo <<<HTML
        <p>Uri variables: {$route->get('arg1')}, {$route->get('arg2')}</p>
        HTML;
    }
}



$request = new Request();
$router = new Router($request);

$router->addRoute(new Route('/', Controller::class . '::root'));
$router->addRoute(new Route('/arg/{arg1}/{arg2}', Controller::class . '::wArg'));
$router->addRoute(new Route('/html', function () {
    global $request;

    (new HttpResponse($request, <<<HTML
    <p>This is a HTML response</p>
    HTML))->send();
}));
$router->addRoute(new Route('/json', function () {
    global $request;

    (new HttpResponse($request, [
        'data' => 'This is a json response',
    ]))->send();
}));



$route = $router->getRouteForRequest();
$handler = $route?->getHandler();

if (!is_null($handler)) {
    call_user_func($handler);
} else {
    echo <<<HTML
    <h1>Resource you are looking for doesn't exist</h1>
    HTML;
}
