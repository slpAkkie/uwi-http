<?php

namespace Framework\Services\Http\Contracts\Routing;

interface UriContract
{
    /**
     * TODO: Undocumented function
     *
     * @param string $uriTemplate
     */
    public function __construct(string $uriTemplate);

    /**
     * TODO: Undocumented function
     *
     * @param string $uriToCompare
     * @return boolean
     */
    public function equalTo(string $uriToCompare): bool;

    /**
     * TODO: Undocumented function
     *
     * @param string $uri
     * @return string
     */
    public static function unify(string $uri): string;

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function __toString(): string;
}
