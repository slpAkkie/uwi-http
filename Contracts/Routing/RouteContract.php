<?php

namespace Services\Http\Contracts\Routing;

interface RouteContract
{
    /**
     * TODO: Undocumented function
     *
     * @param string $method
     * @param string $uriTemplate
     * @param callable $handler
     */
    public function __construct(string $method, string $uriTemplate, callable $handler);

    /**
     * TODO: Undocumented function
     *
     * @return callable
     */
    public function getHandler(): callable;

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
     * @return \Services\Http\Routing\Uri
     */
    public function getUriTemplate(): \Services\Http\Routing\Uri;

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
