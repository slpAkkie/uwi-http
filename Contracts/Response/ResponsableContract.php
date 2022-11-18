<?php

namespace Services\Http\Contracts\Response;

interface ResponsableContract
{
    /**
     * Преобразование данных в форму, которая должна быть отправлена в ответе.
     *
     * @return string|array
     */
    public function toResponse(): string|array;
}
