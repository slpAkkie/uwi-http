<?php

namespace Services\Http\Routing;

use Services\Http\Contracts\Routing\RouterContract;
use Services\Http\Requests\Request;

class Router implements RouterContract
{
    /**
     * TODO: Undocumented variable
     *
     * @var array<\Services\Http\Routing\Route>
     */
    protected array $routes = [];

    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Requests\Request $request
     */
    public function __construct(
        /**
         * TODO: Undocumented variable
         *
         * @var \Services\Http\Requests\Request
         */
        protected Request $request
    ) {
        //
    }

    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Routing\Route $route
     * @return \Services\Http\Routing\Route
     */
    public function addRoute(Route $route): \Services\Http\Routing\Route
    {
        $this->routes[] = $route;

        return $route;
    }

    /**
     * TODO: Undocumented function
     *
     * @return \Services\Http\Routing\Route|null
     */
    public function getRouteForRequest(): ?\Services\Http\Routing\Route
    {
        foreach ($this->routes as $route) {
            if ($route->getUriTemplate()->equalTo($this->request->uri()) && $route->getMethod() === $this->request->method()) {
                $route->extractTemplateArgs($this->request->uri());
                return $route;
            }
        }

        return null;
    }
}
