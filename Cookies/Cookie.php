<?php

namespace Framework\Services\Http\Cookies;

use Framework\Services\Http\Contracts\Cookies\CookieContract;

class Cookie implements CookieContract
{
    /**
     * Сохраняет значение в куки.
     *
     * @param string $key
     * @param string $value
     * @param int|array $expires_or_options
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     * @return string
     */
    public function set(string $key, string $value = "", int|array $expires_or_options = 0, string $path = "", string $domain = "", bool $secure = false, bool $httponly = false): string
    {
        setcookie($key, $value, $expires_or_options, $path, $domain, $secure, $httponly);

        return $_COOKIE[$key] = $value;
    }

    /**
     * Забывает значение в куки по ключу.
     *
     * @param string $key
     * @return void
     */
    public function unset(string $key): void
    {
        if (key_exists($key, $_COOKIE)) {
            $this->set($key, '', -1);
            unset($_COOKIE[$key]);
        }
    }

    /**
     * Очищает куки.
     *
     * @return void
     */
    public function clear(): void
    {
        foreach (array_keys($_COOKIE) as $key) {
            $this->unset($key);
        }
    }

    /**
     * Получить значение из куки по ключу.
     *
     * @param string $key
     * @param string|null $default Значение по умолчанию
     * @return string|null
     */
    public function get(string $key, ?string $default = null): ?string
    {
        return key_exists($key, $_COOKIE)
            ? $_COOKIE[$key]
            : $default;
    }

    /**
     * Получить все данные из куки.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $_COOKIE;
    }
}
