<?php

namespace Services\Http\Contracts\Response;

interface HttpResponseContract
{
    /**
     * Инициализация объекта.
     *
     * @param null|string|array|\Services\Http\Contracts\Response\ResponsableContract $data
     * @param int $responseCode
     */
    public function __construct(null|string|array|ResponsableContract $data = null, int $responseCode);

    /**
     * Получить или установить код ответа.
     *
     * @param int|null $responseCode
     * @return int
     */
    public function responseCode(int|null $responseCode = null): int;

    /**
     * Устанавить заголовок ответа.
     *
     * @return static
     */
    public function setHeader(string $header, string $val): static;

    /**
     * Установить тип ответа на JSON.
     *
     * @return static
     */
    public function json(): static;

    /**
     * Установить тип ответа на HTML страницу.
     *
     * @return static
     */
    public function html(): static;

    /**
     * Установить данные для ответа.
     *
     * @param null|string|array|\Services\Http\Contracts\Response\ResponsableContract $data
     * @return static
     */
    public function setData(null|string|array|ResponsableContract $data): static;

    /**
     * Возвращает данные в форме, которую можно отправить в ответ.
     *
     * @return string
     */
    public function getResponsableData(): string;
}
