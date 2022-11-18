<?php

namespace Services\Http\Contracts\Routing;

use Services\Http\Requests\Request;
use Services\Http\Routing\Route;

interface RouterContract
{
    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Requests\Request $request
     */
    public function __construct(Request $request);

    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Routing\Route $route
     * @return \Services\Http\Routing\Route
     */
    public function addRoute(Route $route): \Services\Http\Routing\Route;

    /**
     * TODO: Undocumented function
     *
     * @return \Services\Http\Routing\Route|null
     */
    public function getRouteForRequest(): ?\Services\Http\Routing\Route;
}
