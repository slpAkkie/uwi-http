<?php

namespace Services\Http\Routing;

use Services\Http\Contracts\Routing\RouteContract;
use Services\Http\Contracts\Routing\UriContract;

class Route implements RouteContract
{
    /**
     * TODO: Undocumented variable
     *
     * @var mixed
     */
    protected UriContract $uriTemplate;

    /**
     * TODO: Undocumented variable
     *
     * @var mixed
     */
    protected mixed $handler;

    /**
     * TODO: Undocumented variable
     *
     * @var string
     */
    protected mixed $method;

    /**
     * TODO: Undocumented variable
     *
     * @var array<string, string>
     */
    protected array $args = [];

    /**
     * TODO: Undocumented function
     *
     * @param string $method
     * @param string $uriTemplate
     * @param callable $handler
     */
    public function __construct(
        string $method,
        string $uriTemplate,
        callable $handler,
    ) {
        $this->method = strtoupper($method);
        $this->uriTemplate = new Uri($uriTemplate);
        $this->handler = $handler;
    }

    /**
     * TODO: Undocumented function
     *
     * @return callable
     */
    public function getHandler(): callable
    {
        return $this->handler;
    }

    /**
     * TODO: Undocumented function
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
     * TODO: Undocumented function
     *
     * @param string $argName
     * @return mixed
     */
    public function get(string $argName): mixed
    {
        return $this->args[$argName];
    }

    /**
     * TODO: Undocumented function
     *
     * @return \Services\Http\Contracts\Routing\UriContract
     */
    public function getUriTemplate(): \Services\Http\Contracts\Routing\UriContract
    {
        return $this->uriTemplate;
    }

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function getUriTemplateAsString(): string
    {
        return (string)$this->uriTemplate;
    }

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
