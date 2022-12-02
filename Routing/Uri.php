<?php

namespace Services\Http\Routing;

use Services\Http\Contracts\Routing\UriContract;

class Uri implements UriContract
{
    /**
     * URI cтрока шаблона запроса.
     *
     * @var string
     */
    protected string $uriTemplate;

    /**
     * Инициализация нового объекта.
     *
     * @param string $uriTemplate
     */
    public function __construct(
        string $uriTemplate,
    ) {
        $this->uriTemplate = Uri::unify($uriTemplate);
    }

    /**
     * Сравнивает URI на то, подходит ли он под шаблон.
     *
     * @param string $uriToCompare
     * @return boolean
     */
    public function equalTo(string $uriToCompare): bool
    {
        // Собираем из шаблона регулярные выражения.
        $routeUri = '/^' . preg_replace(
            ['/\{[^\}]+\}/', '/\//'],
            ['(.*)', '\\/'],
            $this->uriTemplate
        ) . '$/';

        return preg_match($routeUri, $uriToCompare);
    }

    /**
     * Унифицирует URI строку, добавляет слэш в начале и убирает в конце.
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
     * Возвращает шаблон при попытке приведения к строке.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->uriTemplate;
    }
}
