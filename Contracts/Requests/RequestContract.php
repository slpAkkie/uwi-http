<?php

namespace Framework\Services\Http\Contracts\Requests;

interface RequestContract
{
    /**
     * Получить объект Куки.
     *
     * @return \Framework\Services\Http\Contracts\Cookies\CookieContract
     */
    public function cookie(): \Framework\Services\Http\Contracts\Cookies\CookieContract;

    /**
     * Получить объект Сессии.
     *
     * @return \Framework\Services\Http\Contracts\Sessions\SessionContract
     */
    public function session(): \Framework\Services\Http\Contracts\Sessions\SessionContract;

    /**
     * Возвращает значение HTTP заголовка Accept в виде массива.
     *
     * Указывает какие типа контента принимает клиент в ответ на запрос.
     *
     * @return array
     */
    public function accepts(): array;


    /**
     * Возвращает вариант HTTP протокола http или https.
     *
     * @return string
     */
    public function scheme(): string;

    /**
     * Возвращает HTTP хост из заголовка запроса.
     *
     * @return string
     */
    public function host(): string;


    /**
     * Возвращает хоть из запроса вместе со схемой.
     *
     * @return string
     */
    public function fullHost(): string;

    /**
     * Возвращает true, если запрос пришел по защищеному протоколу https.
     *
     * @return boolean
     */
    public function isSecure(): bool;

    /**
     * Возвращает user-agent клиента.
     *
     * @return string
     */
    public function userAgent(): string;

    /**
     * Возвращает ip клиента.
     *
     * @return string
     */
    public function ip(): string;

    /**
     * Возвращает HTTP метод запроса.
     *
     * @return string
     */
    public function method(): string;

    /**
     * Возвращает URI строку запроса как есть (Включая GET параметры).
     *
     * @return string
     */
    public function uriWithArgs(): string;

    /**
     * Возвращает URI строку без GET параметров.
     *
     * @return string
     */
    public function uri(): string;

    /**
     * Возврашает всю информацию известную о запросе.
     *
     * @return array<string, mixed>
     */
    public function all(): array;

    /**
     * Возвращает значение из массива $_REQUEST по ключу.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getFromRequest(string $key, mixed $default = null): mixed;

    /**
     * Получить значение запроса по ключу.
     *
     * Поиск происходит в следующем порядке: $_POST, $_GET, $_FILES.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Получить информацию о загруженных файлах по ключу.
     *
     * @param string $key
     * @return string|null
     */
    public function file(string $key): ?string;
}
