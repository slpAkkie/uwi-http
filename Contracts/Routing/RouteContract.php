<?php

namespace Framework\Services\Http\Contracts\Routing;

interface RouteContract
{
    /**
     * TODO: Undocumented function
     *
     * @param string $uriTemplate
     * @param callable $handler
     */
    public function __construct(string $uriTemplate, callable $handler);

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
     * @return \Framework\Services\Http\Routing\Uri
     */
    public function getUriTemplate(): \Framework\Services\Http\Routing\Uri;

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function getUriTemplateAsString(): string;
}
