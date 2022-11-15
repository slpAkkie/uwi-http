<?php

namespace Framework\Services\Http\Contracts\Routing;

use Framework\Services\Http\Requests\Request;
use Framework\Services\Http\Routing\Route;

interface RouterContract
{
    /**
     * TODO: Undocumented function
     *
     * @param \Framework\Services\Http\Requests\Request $request
     */
    public function __construct(Request $request);

    /**
     * TODO: Undocumented function
     *
     * @param \Framework\Services\Http\Routing\Route $route
     * @return \Framework\Services\Http\Routing\Route
     */
    public function addRoute(Route $route): \Framework\Services\Http\Routing\Route;

    /**
     * TODO: Undocumented function
     *
     * @return \Framework\Services\Http\Routing\Route|null
     */
    public function getRouteForRequest(): ?\Framework\Services\Http\Routing\Route;
}
