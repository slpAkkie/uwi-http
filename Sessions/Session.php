<?php

namespace Services\Http\Sessions;

use Services\Http\Contracts\Sessions\SessionContract;

class Session implements SessionContract
{
    /**
     * Путь к дериктории для хранения файлов сессий по умолчанию.
     *
     * @var string
     */
    protected const DEFAULT_SESSIONS_PATH = APP_ROOT_PATH . '/storage/framework/sessions';

    /**
     * Инициализация объекта сессии.
     *
     * @param ?string $sessionsPath
     */
    public function __construct(?string $sessionsPath = null)
    {
        ini_set('session.use_strict_mode', 1);
        $this->usePath($sessionsPath ?? static::DEFAULT_SESSIONS_PATH);
    }

    /**
     * Использовать выбранную директории как хранилище для файлов сессии.
     *
     * @param string $path
     * @return void
     */
    public function usePath(string $path): void
    {
        session_save_path($path);
    }

    /**
     * Деструктор, чтобы закрыть сессию при внезапном удалении объекта.
     */
    public function __destruct()
    {
        $this->commit();
    }

    /**
     * Сохраняет значения из массива в сессию по ключам.
     *
     * @param array<string, mixed> $vars Массив переменных окружения.
     * @return void
     */
    public function setMany(array $vars = []): void
    {
        $_SESSION = array_merge($_SESSION, $vars);
    }

    /**
     * Сохраняет значение в сессию.
     *
     * @param string $key
     * @param string $val
     * @return string
     */
    public function set(string $key, string $val): string
    {
        return $_SESSION[$key] = $val;
    }

    /**
     * Забывает значение в сессии по ключу.
     *
     * @param string $key
     * @return void
     */
    public function unset(string $key): void
    {
        if (key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Очищает сессию.
     *
     * @return void
     */
    public function clear(): void
    {
        $_SESSION = [];
    }

    /**
     * Получить значение из сессии по ключу.
     *
     * @param string $key
     * @param string|null $default Значение по умолчанию
     * @return string|null
     */
    public function get(string $key, ?string $default = null): ?string
    {
        return key_exists($key, $_SESSION)
            ? $_SESSION[$key]
            : $default;
    }

    /**
     * Получить все данные из сесии.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $_SESSION;
    }

    /**
     * Запустить сессию
     *
     * @return void
     */
    public function start(): void
    {
        session_start();
    }

    /**
     * Записать данные в сессию и закрыть ее.
     *
     * @return void
     */
    public function commit(): void
    {
        session_commit();
        $this->clear();
    }

    /**
     * Отменить изменения в сессии и закрыть ее.
     *
     * @return void
     */
    public function abort(): void
    {
        session_abort();
    }

    /**
     * Отменяет изменения в сессии. Сессию остается открытой.
     *
     * @return void
     */
    public function revert(): void
    {
        session_reset();
    }

    /**
     * Уничтожить сессию.
     *
     * @return void
     */
    public function destory(): void
    {
        $this->clear();
        session_destroy();
    }

    /**
     * Перезапустить сессию.
     *
     * @return void
     */
    public function regenerate(): void
    {
        $this->destory();
        $this->start();
    }
}
