<?php

namespace Services\Http\Contracts\Routing;

interface RouteContract
{
    /**
     * Инициализировать новый маршрут.
     *
     * @param string $method
     * @param string $uriTemplate
     * @param mixed $handler
     */
    public function __construct(string $method, string $uriTemplate, mixed $handler);

    /**
     * Возвращает обработчик маршрута.
     *
     * @return mixed
     */
    public function getHandler(): mixed;

    /**
     * Извлечь аргументы из URI строки по шаблону маршрута.
     *
     * @param string $uri
     * @return void
     */
    public function extractTemplateArgs(string $uri): void;

    /**
     * Получить аргумент по его имени.
     *
     * @param string $argName
     * @return mixed
     */
    public function get(string $argName): mixed;

    /**
     * Получить шаблон URI строки маршрута.
     *
     * @return \Services\Http\Contracts\Routing\UriContract
     */
    public function getUriTemplate(): \Services\Http\Contracts\Routing\UriContract;

    /**
     * Получить шаблон URI строки маршрута как строку.
     *
     * @return string
     */
    public function getUriTemplateAsString(): string;

    /**
     * Получить метод, по которому доступен маршрут.
     *
     * @return string
     */
    public function getMethod(): string;
}
