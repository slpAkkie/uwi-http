<?php

namespace Services\Http\Routing;

use Services\Http\Contracts\Requests\RequestContract;
use Services\Http\Contracts\Routing\RouteContract;
use Services\Http\Contracts\Routing\RouterContract;

class Router implements RouterContract
{
    /**
     * TODO: Undocumented variable
     *
     * @var array<\Services\Http\Contracts\Routing\RouteContract>
     */
    protected array $routes = [];

    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Contracts\Requests\RequestContract $request
     */
    public function __construct(
        /**
         * TODO: Undocumented variable
         *
         * @var \Services\Http\Contracts\Requests\RequestContract
         */
        protected RequestContract $request
    ) {
        //
    }

    /**
     * TODO: Undocumented function
     *
     * @param \Services\Http\Contracts\Routing\RouteContract $route
     * @return \Services\Http\Contracts\Routing\RouteContract
     */
    public function addRoute(RouteContract $route): \Services\Http\Contracts\Routing\RouteContract
    {
        $this->routes[] = $route;

        return $route;
    }

    /**
     * TODO: Undocumented function
     *
     * @return \Services\Http\Contracts\Routing\RouteContract|null
     */
    public function getRouteForRequest(): ?\Services\Http\Contracts\Routing\RouteContract
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
