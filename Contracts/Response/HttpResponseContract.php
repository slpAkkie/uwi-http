<?php

namespace Framework\Services\Http\Contracts\Response;

use Framework\Services\Http\Contracts\Requests\RequestContract;

interface HttpResponseContract
{
    /**
     * Инициализация объекта.
     *
     * @param \Framework\Services\Http\Contracts\Requests\RequestContract $request
     * @param string|array|\Framework\Services\Http\Contracts\Response\ResponsableContract|null $data
     * @param int $responseCode
     */
    public function __construct(RequestContract $request, string|array|ResponsableContract|null $data = null, int $responseCode);

    /**
     * Получить или установить код ответа.
     *
     * @param integer|null $statusCode
     * @return \Framework\Services\Http\Contracts\Response\HttpResponseContract
     */
    public function statusCode(int|null $statusCode = null): \Framework\Services\Http\Contracts\Response\HttpResponseContract;

    /**
     * Установить тип ответа на JSON.
     *
     * @param array|\Framework\Services\Http\Contracts\Response\ResponsableContract $data
     * @param int $responseCode
     * @return \Framework\Services\Http\Contracts\Response\HttpResponseContract
     */
    public function json(array|ResponsableContract $data = null, int $responseCode = null): \Framework\Services\Http\Contracts\Response\HttpResponseContract;

    /**
     * Установить тип ответа на HTML страницу.
     *
     * @param string|\Framework\Services\Http\Contracts\Response\ResponsableContract $data
     * @param int $responseCode
     * @return \Framework\Services\Http\Contracts\Response\HttpResponseContract
     */
    public function html(string|ResponsableContract $data = null, int $responseCode = null): \Framework\Services\Http\Contracts\Response\HttpResponseContract;

    /**
     * Отправить ответ клиенту.
     *
     * @return void
     */
    public function send(): void;
}
