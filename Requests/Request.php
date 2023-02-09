<?php

namespace Services\Http\Requests;

use Services\Http\Contracts\Cookies\CookieContract;
use Services\Http\Contracts\Requests\RequestContract;
use Services\Http\Contracts\Sessions\SessionContract;
use Services\Http\Cookies\Cookie;
use Services\Http\Sessions\Session;

class Request implements RequestContract
{
    /**
     * Объект сессии.
     *
     * @var \Services\Http\Contracts\Sessions\SessionContract
     */
    protected SessionContract $_session;

    /**
     * Объект Куки.
     *
     * @var \Services\Http\Contracts\Cookies\CookieContract
     */
    protected CookieContract $_cookie;

    /**
     * Получить объект Куки.
     *
     * @return \Services\Http\Contracts\Cookies\CookieContract
     */
    public function cookie(): \Services\Http\Contracts\Cookies\CookieContract
    {
        if (!isset($this->_cookie)) {
            $this->_cookie = new Cookie();
        }

        return $this->_cookie;
    }

    /**
     * Получить объект Сессии.
     *
     * @return \Services\Http\Contracts\Sessions\SessionContract
     */
    public function session(): \Services\Http\Contracts\Sessions\SessionContract
    {
        if (!isset($this->_session)) {
            $this->_session = new Session();
        }

        return $this->_session;
    }

    /**
     * Возвращает значение HTTP заголовка Accept в виде массива.
     *
     * Указывает какие типа контента принимает клиент в ответ на запрос.
     *
     * @return array
     */
    public function accepts(): array
    {
        return array_map(function ($mime) {
            return explode(';', $mime)[0];
        }, explode(',', $_SERVER['HTTP_ACCEPT']));
    }


    /**
     * Возвращает вариант HTTP протокола http или https.
     *
     * @return string
     */
    public function scheme(): string
    {
        return $this->isSecure() ? 'https' : 'http';
    }

    /**
     * Возвращает HTTP хост из заголовка запроса.
     *
     * @return string
     */
    public function host(): string
    {
        return $_SERVER['HTTP_HOST'];
    }


    /**
     * Возвращает хоть из запроса вместе со схемой.
     *
     * @return string
     */
    public function fullHost(): string
    {
        return $this->scheme() . '://' . $this->host();
    }

    /**
     * Возвращает true, если запрос пришел по защищеному протоколу https.
     *
     * @return boolean
     */
    public function isSecure(): bool
    {
        return key_exists('HTTPS', $_SERVER);
    }

    /**
     * Возвращает user-agent клиента.
     *
     * @return string
     */
    public function userAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Возвращает ip клиента.
     *
     * @return string
     */
    public function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Возвращает HTTP метод запроса.
     *
     * @return string
     */
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Возвращает URI строку запроса как есть (Включая GET параметры).
     *
     * @return string
     */
    public function uriWithArgs(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Возвращает URI строку без GET параметров.
     *
     * @return string
     */
    public function uri(): string
    {
        return explode('?', $this->uriWithArgs(), 2)[0];
    }

    /**
     * Возврашает всю информацию известную о запросе.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $_REQUEST;
    }

    /**
     * Возвращает значение из массива $_REQUEST по ключу.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getFromRequest(string $key, mixed $default = null): mixed
    {
        return key_exists($key, $_REQUEST) ? $_REQUEST[$key] : $default;
    }

    /**
     * Получить значение запроса по ключу.
     *
     * Поиск происходит в следующем порядке: $_POST, $_GET, $_FILES.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if (key_exists($key, $_POST)) {
            return $_POST[$key];
        }

        if (key_exists($key, $_GET)) {
            return $_GET[$key];
        }

        return $this->file($key) ?? $default;
    }

    /**
     * Получить информацию о загруженных файлах по ключу.
     *
     * @param string $key
     * @return string|null
     */
    public function file(string $key): ?string
    {
        return key_exists($key, $_FILES) ? $_FILES[$key] : null;
    }
}
