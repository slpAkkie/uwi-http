<?php

namespace Framework\Services\Http\Routing;

use Framework\Services\Http\Contracts\Routing\RouterContract;
use Framework\Services\Http\Requests\Request;

class Router implements RouterContract
{
    /**
     * TODO: Undocumented variable
     *
     * @var array<\Framework\Services\Http\Routing\Route>
     */
    protected array $routes = [];

    /**
     * TODO: Undocumented function
     *
     * @param \Framework\Services\Http\Requests\Request $request
     */
    public function __construct(
        /**
         * TODO: Undocumented variable
         *
         * @var \Framework\Services\Http\Requests\Request
         */
        protected Request $request
    ) {
        //
    }

    /**
     * TODO: Undocumented function
     *
     * @param \Framework\Services\Http\Routing\Route $route
     * @return \Framework\Services\Http\Routing\Route
     */
    public function addRoute(Route $route): \Framework\Services\Http\Routing\Route
    {
        $this->routes[] = $route;

        return $route;
    }

    /**
     * TODO: Undocumented function
     *
     * @return \Framework\Services\Http\Routing\Route|null
     */
    public function getRouteForRequest(): ?\Framework\Services\Http\Routing\Route
    {
        foreach ($this->routes as $route) {
            if ($route->getUriTemplate()->equalTo($this->request->uri())) {
                $route->extractTemplateArgs($this->request->uri());
                return $route;
            }
        }

        return null;
    }
}
