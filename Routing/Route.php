<?php

namespace Services\Http\Routing;

use Services\Http\Contracts\Routing\RouteContract;
use Services\Http\Contracts\Routing\UriContract;

class Route implements RouteContract
{
    /**
     * Шаблон URI которому соответствует маршрут.
     *
     * @var mixed
     */
    protected UriContract $uriTemplate;

    /**
     * Обработчик маршрута.
     *
     * @var mixed
     */
    protected mixed $handler;

    /**
     * HTTP метод, которым был отправлен запрос.
     *
     * @var string
     */
    protected mixed $method;

    /**
     * Аргументы URI строки по шаблону.
     *
     * @var array<string, string>
     */
    protected array $args = [];

    /**
     * Инициализировать новый маршрут.
     *
     * @param string $method
     * @param string $uriTemplate
     * @param mixed $handler
     */
    public function __construct(
        string $method,
        string $uriTemplate,
        mixed $handler,
    ) {
        $this->method = strtoupper($method);
        $this->uriTemplate = new Uri($uriTemplate);
        $this->handler = $handler;
    }

    /**
     * Возвращает обработчик маршрута.
     *
     * @return mixed
     */
    public function getHandler(): mixed
    {
        return $this->handler;
    }

    /**
     * Извлечь аргументы из URI строки по шаблону маршрута.
     *
     * @param string $uri
     * @return void
     */
    public function extractTemplateArgs(string $uri): void
    {
        $uri = explode('/', Uri::unify($uri));
        $uriTemplate = explode('/', $this->uriTemplate);

        for ($i = 0; $i < count($uriTemplate); $i++) {
            if (preg_match('/^\{(.*)\}$/', $uriTemplate[$i])) {
                $this->args[substr($uriTemplate[$i], 1, -1)] = $uri[$i];
            }
        }
    }

    /**
     * Получить аргумент по его имени.
     *
     * @param string $argName
     * @return mixed
     */
    public function get(string $argName): mixed
    {
        return $this->args[$argName];
    }

    /**
     * Получить шаблон URI строки маршрута.
     *
     * @return \Services\Http\Contracts\Routing\UriContract
     */
    public function getUriTemplate(): \Services\Http\Contracts\Routing\UriContract
    {
        return $this->uriTemplate;
    }

    /**
     * Получить шаблон URI строки маршрута как строку.
     *
     * @return string
     */
    public function getUriTemplateAsString(): string
    {
        return (string)$this->uriTemplate;
    }

    /**
     * Получить метод, по которому доступен маршрут.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
