<?php

namespace Services\Http\Response;

use Services\Http\Contracts\Response\HttpResponseContract;
use Services\Http\Contracts\Response\ResponsableContract;

class HttpResponse implements HttpResponseContract
{
    /**
     * Инициализация объекта.
     *
     * @param null|string|array|\Services\Http\Contracts\Response\ResponsableContract $data
     * @param int $responseCode
     */
    public function __construct(
        /**
         * Данные ответа.
         *
         * @var string|array|\Services\Http\Contracts\Response\ResponsableContract
         */
        protected null|string|array|ResponsableContract $data = null,
        /**
         * Код ответа.
         *
         * @var string|array|\Services\Http\Contracts\Response\ResponsableContract
         */
        protected int $responseCode,
    ) {
        $this->setData($data);
        $this->responseCode($responseCode);
    }

    /**
     * Получить или установить код ответа.
     *
     * @param int|null $statusCode
     * @return int
     */
    public function responseCode(int|null $responseCode = null): int
    {
        if (!is_null($responseCode)) {
            $this->responseCode = $responseCode;

            http_response_code($this->responseCode);
        }

        return $this->responseCode;
    }

    /**
     * Устанавить заголовок ответа.
     *
     * @return static
     */
    public function setHeader(string $header, string $val): static
    {
        header("$header: $val");

        return $this;
    }

    /**
     * Установить тип ответа на JSON.
     *
     * @return static
     */
    public function json(): static
    {
        $this->setHeader('Content-Type', 'application/json');

        return $this;
    }

    /**
     * Установить тип ответа на HTML страницу.
     *
     * @return static
     */
    public function html(): static
    {
        $this->setHeader('Content-Type', 'text/html');

        return $this;
    }

    /**
     * Установить данные для ответа.
     *
     * @param null|string|array|ResponsableContract $data
     * @return static
     */
    public function setData(null|string|array|ResponsableContract $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Возвращает данные в форме, которую можно отправить в ответ.
     *
     * @return string
     */
    public function getResponsableData(): string
    {
        $responsableData = is_subclass_of($this->data, ResponsableContract::class)
            ? $this->data->toResponse()
            : $this->data;

        return !is_null($responsableData) && !is_string($responsableData)
            ? json_encode($responsableData)
            : $responsableData;
    }
}
