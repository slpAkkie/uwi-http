<?php

namespace Framework\Services\Http\Contracts\Sessions;

interface SessionContract
{
    /**
     * Инициализация объекта сессии.
     *
     * @param ?string $sessionsPath
     */
    public function __construct(?string $sessionsPath = null);

    /**
     * Сохраняет значения из массива в сессию по ключам.
     *
     * @param array<string, mixed> $vars Массив переменных окружения.
     * @return void
     */
    public function setMany(array $vars = []): void;

    /**
     * Сохраняет значение в сессию.
     *
     * @param string $key
     * @param string $val
     * @return string
     */
    public function set(string $key, string $val): string;

    /**
     * Забывает значение в сессии по ключу.
     *
     * @param string $key
     * @return void
     */
    public function unset(string $key): void;

    /**
     * Очищает сессию.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Получить значение из сессии по ключу.
     *
     * @param string $key
     * @param string|null $default Значение по умолчанию
     * @return string|null
     */
    public function get(string $key, ?string $default = null): ?string;

    /**
     * Получить все данные из сесии.
     *
     * @return array<string, mixed>
     */
    public function all(): array;

    /**
     * Запустить сессию
     *
     * @return void
     */
    public function start(): void;

    /**
     * Записать данные в сессию и закрыть ее.
     *
     * @return void
     */
    public function commit(): void;

    /**
     * Отменить изменения в сессии и закрыть ее.
     *
     * @return void
     */
    public function abort(): void;

    /**
     * Отменяет изменения в сессии. Сессию остается открытой.
     *
     * @return void
     */
    public function revert(): void;

    /**
     * Уничтожить сессию.
     *
     * @return void
     */
    public function destory(): void;

    /**
     * Перезапустить сессию.
     *
     * @return void
     */
    public function regenerate(): void;
}
