<?php

namespace Services\Http\Contracts\Routing;

use Services\Http\Contracts\Requests\RequestContract;

interface RouterContract
{
    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Contracts\Requests\RequestContract $request
     */
    public function __construct(RequestContract $request);

    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Contracts\Routing\RouteContract $route
     * @return \Services\Http\Contracts\Routing\RouteContract
     */
    public function addRoute(RouteContract $route): \Services\Http\Contracts\Routing\RouteContract;

    /**
     * TODO: Undocumented function
     *
     * @return \Services\Http\Contracts\Routing\RouteContract|null
     */
    public function getRouteForRequest(): ?\Services\Http\Contracts\Routing\RouteContract;
}
