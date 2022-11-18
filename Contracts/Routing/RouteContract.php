<?php

namespace Services\Http\Contracts\Routing;

interface RouteContract
{
    /**
     * TODO: Undocumented function
     *
     * @param string $method
     * @param string $uriTemplate
     * @param mixed $handler
     */
    public function __construct(string $method, string $uriTemplate, mixed $handler);

    /**
     * TODO: Undocumented function
     *
     * @return mixed
     */
    public function getHandler(): mixed;

    /**
     * TODO: Undocumented function
     *
     * @param string $uri
     * @return void
     */
    public function extractTemplateArgs(string $uri): void;

    /**
     * TODO: Undocumented function
     *
     * @param string $argName
     * @return mixed
     */
    public function get(string $argName): mixed;

    /**
     * TODO: Undocumented function
     *
     * @return \Services\Http\Contracts\Routing\UriContract
     */
    public function getUriTemplate(): \Services\Http\Contracts\Routing\UriContract;

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function getUriTemplateAsString(): string;

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function getMethod(): string;
}
