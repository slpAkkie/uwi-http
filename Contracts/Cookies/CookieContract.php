<?php

namespace Services\Http\Contracts\Cookies;

interface CookieContract
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
    public function set(string $key, string $value = "", int|array $expires_or_options = 0, string $path = "", string $domain = "", bool $secure = false, bool $httponly = false): string;

    /**
     * Забывает значение в куки по ключу.
     *
     * @param string $key
     * @return void
     */
    public function unset(string $key): void;

    /**
     * Очищает куки.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Получить значение из куки по ключу.
     *
     * @param string $key
     * @param string|null $default Значение по умолчанию
     * @return string|null
     */
    public function get(string $key, ?string $default = null): ?string;

    /**
     * Получить все данные из куки.
     *
     * @return array<string, mixed>
     */
    public function all(): array;
}
