<?php

use Services\Http\Cookies\Cookie;
use TestModule\Test;

class CookieUnitTest
{
    public function __construct(
        protected $cookie = new Cookie(),
    ) {
        //
    }

    public function all(): void
    {
        Test::printInfo('Тест уставноки и чтения значений в Cookies'); {
            $key = 'key';
            $val = 'val';

            Test::run(
                desc: 'Присвоить значение и проверить что оно установлено',
                test: function () use ($key, $val) {
                    $this->cookie->set($key, $val);

                    Test::assertEqual($this->cookie->get($key), $val);
                }
            );

            Test::run(
                desc: 'Удаление куки',
                test: function () use ($key) {
                    $this->cookie->unset($key);

                    $unsetValue = $this->cookie->get($key);
                    Test::assertNull($unsetValue);
                }
            );
        }
    }
}
