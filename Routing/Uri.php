<?php

namespace Services\Http\Routing;

use Services\Http\Contracts\Routing\UriContract;

class Uri implements UriContract
{
    /**
     * TODO: Undocumented variable
     *
     * @var string
     */
    protected string $uriTemplate;

    /**
     * TODO: Undocumented function
     *
     * @param string $uriTemplate
     */
    public function __construct(
        string $uriTemplate,
    ) {
        $this->uriTemplate = Uri::unify($uriTemplate);
    }

    /**
     * TODO: Undocumented function
     *
     * @param string $uriToCompare
     * @return boolean
     */
    public function equalTo(string $uriToCompare): bool
    {
        $routeUri = '/^' . preg_replace(
            ['/\{[^\}]+\}/', '/\//'],
            ['(.*)', '\\/'],
            $this->uriTemplate
        ) . '$/';

        return preg_match($routeUri, $uriToCompare);
    }

    /**
     * TODO: Undocumented function
     *
     * @param string $uri
     * @return string
     */
    public static function unify(string $uri): string
    {
        if (!str_starts_with($uri, '/')) {
            $uri = '/' . $uri;
        }

        if (str_ends_with($uri, '/') && strlen($uri) !== 1) {
            $uri = substr($uri, 0, -1);
        }

        return $uri;
    }

    /**
     * TODO: Undocumented function
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->uriTemplate;
    }
}
