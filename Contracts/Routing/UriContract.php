<?php

namespace Services\Http\Contracts\Routing;

interface UriContract
{
    /**
     * Инициализация нового объекта.
     *
     * @param string $uriTemplate
     */
    public function __construct(string $uriTemplate);

    /**
     * Сравнивает URI на то, подходит ли он под шаблон.
     *
     * @param string $uriToCompare
     * @return boolean
     */
    public function equalTo(string $uriToCompare): bool;

    /**
     * Унифицирует URI строку, добавляет слэш в начале и убирает в конце.
     *
     * @param string $uri
     * @return string
     */
    public static function unify(string $uri): string;

    /**
     * Возвращает шаблон при попытке приведения к строке.
     *
     * @return string
     */
    public function __toString(): string;
}
