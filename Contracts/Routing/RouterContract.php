<?php

namespace Services\Http\Contracts\Routing;

use Services\Http\Contracts\Requests\RequestContract;

interface RouterContract
{
    /**
     * Инициализировать новый маршрутизатор.
     *
     * @param \Services\Http\Contracts\Requests\RequestContract $request
     */
    public function __construct(RequestContract $request);

    /**
     * Добавить новый маршрут.
     *
     * @param \Services\Http\Contracts\Routing\RouteContract $route
     * @return \Services\Http\Contracts\Routing\RouteContract
     */
    public function addRoute(RouteContract $route): \Services\Http\Contracts\Routing\RouteContract;

    /**
     * Получить маршрут для запроса.
     *
     * @return \Services\Http\Contracts\Routing\RouteContract|null
     */
    public function getRouteForRequest(): ?\Services\Http\Contracts\Routing\RouteContract;
}
