<?php

use Services\Http\Contracts\Requests\RequestContract;
use Services\Http\Contracts\Routing\RouteContract;
use Services\Http\Contracts\Routing\RouterContract;
use Services\Http\Requests\Request;
use Services\Http\Response\HttpResponse;
use Services\Http\Routing\Route;
use Services\Http\Routing\Router;
use TestModule\Test;

class RoutingUnitTest
{
    protected ?RequestContract $request = null;
    protected ?RouterContract $router = null;

    public function __construct()
    {
        //
    }

    protected function setTestRequest(string $path = '/', array $args = [], string $method = 'get'): void
    {
        /** Данные запроса для тестирования */
        $method = strtoupper($method);
        $httpParamArray = '_' . $method;

        $_REQUEST = $$httpParamArray = $args;

        $getArgs = '';

        if (count($_GET) > 0) {
            $getArgs = '?' . join('&', array_reduce(array_keys($_GET), function ($carry, $key) {
                $carry[] = $key . '=' . $_GET[$key];

                return $carry;
            }, []));
        }

        if (!str_starts_with($path, '/')) {
            $path = '/' . $path;
        }

        $_SERVER = [
            'REQUEST_URI' => $path . $getArgs,
            'REMOTE_ADDR' => '127.0.0.1',
            'REQUEST_METHOD' => $method,
            'HTTP_HOST' => 'localhost:8001',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
            'HTTP_ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
        ];
    }

    protected function executeCurrentRouteHandler(...$args): string
    {
        $route = $this->router->getRouteForRequest();
        if (is_null($route)) {
            return null;
        }

        $handler = $route->getHandler();
        if (is_array($handler) && is_string($handler[0])) {
            return (new $handler[0]())->{$handler[1]}(...$args);
        }

        return $handler(...$args);
    }

    public function all(): void
    {
        $this->testInstantiateObjects();
        $this->testAddRoutes();
        $this->testRouteHandlers();
    }

    protected function testInstantiateObjects(): void
    {
        Test::printInfo('Создание объектов HTTP сервиса');

        Test::run(
            desc: 'Создание экземпляра Request',
            test: function () {
                Test::assertNonException(function () {
                    $this->request = new Request();
                });
            }
        );

        Test::run(
            desc: 'Создание экземпляра Router',
            test: function () {
                Test::assertNonException(function () {
                    $this->router = new Router($this->request);
                });
            }
        );
    }

    public function testAddRoutes(): void
    {
        Test::printInfo('Регистрация обработчиков на маршруты');

        Test::run(
            desc: 'Обработчиком является метод класса',
            test: function () {
                Test::assertNonException(function () {
                    $this->router->addRoute(new Route('get', '/', [Controller::class, 'root']));
                });
            }
        );

        Test::run(
            desc: 'Части маршрута являются вариативными параметрами',
            test: function () {
                Test::assertNonException(function () {
                    $this->router->addRoute(new Route('post', '/arg/{arg1}/{arg2}', Controller::class . '::wArg'));
                });
            }
        );

        Test::run(
            desc: 'Обработчиком маршрутов выступает callback',
            test: function () {
                Test::assertNonException(function () {
                    $this->router->addRoute(new Route('get', '/html', function () {
                        return (new HttpResponse('Hello world', 200))->getResponsableData();
                    }));
                    $this->router->addRoute(new Route('get', '/json', function () {
                        return (new HttpResponse([
                            'data' => 'Hello world',
                        ], 200))->json()->getResponsableData();
                    }));
                });
            }
        );
    }

    public function testRouteHandlers(): void
    {
        Test::printInfo('Проверка ответов по маршрутам');

        Test::run(
            desc: 'Получить ответ на запрос на главную страницу',
            test: function () {
                $this->setTestRequest();

                Test::assertTrue($this->executeCurrentRouteHandler() === 'root');
            }
        );

        Test::run(
            desc: 'Получить ответ на запрос на страницу, где часть маршрута является параметром',
            test: function () {
                $this->setTestRequest(path: '/arg/val1/val2', method: 'post');

                Test::assertTrue($this->executeCurrentRouteHandler($this->router->getRouteForRequest()) === 'val1;val2');
            }
        );

        Test::run(
            desc: 'HTML ответ на простой запрос',
            test: function () {
                $this->setTestRequest('/html');

                Test::assertTrue($this->executeCurrentRouteHandler() === 'Hello world');
            }
        );

        Test::run(
            desc: 'JSON ответ на простой запрос',
            test: function () {
                $this->setTestRequest('/json');

                Test::assertTrue($this->executeCurrentRouteHandler() === json_encode(['data' => 'Hello world']));
            }
        );
    }
}

class Controller
{
    public function root()
    {
        return 'root';
    }

    public static function wArg(RouteContract $route)
    {
        return $route->get('arg1') . ';' . $route->get('arg2');
    }
}
