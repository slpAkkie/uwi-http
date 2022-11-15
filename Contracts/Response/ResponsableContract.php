<?php

namespace Framework\Services\Http\Contracts\Response;

use Framework\Services\Http\Contracts\Requests\RequestContract;

interface ResponsableContract
{
    /**
     * Преобразование данных в форму, которая должна быть отправлена в ответе.
     *
     * @param \Framework\Services\Http\Contracts\Requests\RequestContract $request
     * @return string|array
     */
    public function toResponse(RequestContract $request): string|array;
}
