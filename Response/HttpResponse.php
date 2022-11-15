<?php

namespace Framework\Services\Http\Response;

use Framework\Services\Http\Contracts\Requests\RequestContract;
use Framework\Services\Http\Contracts\Response\HttpResponseContract;
use Framework\Services\Http\Contracts\Response\ResponsableContract;

class HttpResponse implements HttpResponseContract
{
    /**
     * Код ответа по умолчанию.
     */
    protected const DEFAULT_RESPONSE_CODE = 200;

    /**
     * Список заголовков для ответа.
     *
     * @var array<string, string>
     */
    protected array $headers = [];

    /**
     * Инициализация объекта.
     *
     * @param \Framework\Services\Http\Contracts\Requests\RequestContract $request
     * @param string|array|\Framework\Services\Http\Contracts\Response\ResponsableContract $data|null
     * @param int $responseCode
     */
    public function __construct(
        /**
         * TODO: Undocumented variable
         *
         * @var RequestContract
         */
        protected RequestContract $request,
        /**
         * TODO: Undocumented variable
         *
         * @var string|array|ResponsableContract|null
         */
        protected string|array|ResponsableContract|null $data = null,
        /**
         * TODO: Undocumented variable
         *
         * @var string|array|ResponsableContract
         */
        protected int $responseCode = self::DEFAULT_RESPONSE_CODE,
    ) {
        //
    }

    /**
     * Получить или установить код ответа.
     *
     * @param integer|null $statusCode
     * @return \Framework\Services\Http\Contracts\Response\HttpResponseContract
     */
    public function statusCode(int|null $statusCode = null): \Framework\Services\Http\Contracts\Response\HttpResponseContract
    {
        if (!is_null($statusCode)) {
            $this->responseCode = $statusCode;
        }

        return $this;
    }

    /**
     * Добавить заголовок к ответу.
     *
     * @param string $header
     * @param string $val
     * @return void
     */
    protected function pushHeader(string $header, string $val): void
    {
        $this->headers[$header] = $val;
    }

    /**
     * Установить добавленные заголовки для ответа.
     *
     * @return void
     */
    protected function setHeaders(): void
    {
        http_response_code($this->responseCode);
        $this->statusCode();

        foreach ($this->headers as $header => $val) {
            $this->setHeader($header, $val);
        }
    }

    /**
     * Установить заголовок для ответа.
     *
     * @return void
     */
    protected function setHeader(string $header, string $val): void
    {
        header("$header: $val");
    }

    /**
     * Установить тип ответа на JSON.
     *
     * @param array|\Framework\Services\Http\Contracts\Response\ResponsableContract $data
     * @param int $responseCode
     * @return \Framework\Services\Http\Contracts\Response\HttpResponseContract
     */
    public function json(array|ResponsableContract $data = null, int $responseCode = null): \Framework\Services\Http\Contracts\Response\HttpResponseContract
    {
        $this->data = json_encode($data ?? $this->data ?? []);
        $this->pushHeader('Content-Type', 'application/json');
        $this->statusCode($responseCode);

        return $this;
    }

    /**
     * Установить тип ответа на HTML страницу.
     *
     * @param string|\Framework\Services\Http\Contracts\Response\ResponsableContract $data
     * @param int $responseCode
     * @return \Framework\Services\Http\Contracts\Response\HttpResponseContract
     */
    public function html(string|ResponsableContract $data = null, int $responseCode = null): \Framework\Services\Http\Contracts\Response\HttpResponseContract
    {
        $this->data = $data ?? $this->data;
        $this->pushHeader('Content-Type', 'text/html');
        $this->statusCode($responseCode ?? self::DEFAULT_RESPONSE_CODE);

        return $this;
    }

    /**
     * Подготовить данные для отправки.
     *
     * Данные ответа преобразовываются в строку.
     *
     * @return void
     */
    protected function prepareData(): void
    {
        $response = is_subclass_of($this->data, ResponsableContract::class)
            ? $this->data->toResponse($this->request)
            : $this->data;

        if (is_string($response)) {
            $this->html($response);
        } else {
            $this->json($response);
        }
    }

    /**
     * Отправить ответ клиенту.
     *
     * @return void
     */
    public function send(): void
    {
        $this->prepareData();
        $this->setHeaders();

        echo $this->data;
    }
}
