<?php

use Services\Http\Contracts\Sessions\SessionContract;
use Services\Http\Sessions\Session;
use TestModule\Test;

class SessionUnitTest
{
    protected ?SessionContract $session = null;

    public function __construct()
    {
        Test::printInfo('Инициализация объекта сессии и ее запуск');

        Test::run(
            desc: 'Создание экземпляра сессии',
            test: function () {
                $this->session = new Session(APP_ROOT_PATH . '/sessions');
                $this->session->start();

                Test::assertNonNull($this->session);
            }
        );
    }

    public function all(): void
    {
        if (is_null($this->session)) {
            Test::printError('Объект сесии не был создан, дальнейшее тестирование не возможно');
            return;
        }

        $this->testSetValues();
    }

    protected function testSetValues(): void
    {
        Test::printInfo('Тест уставноки и чтения значений сессии'); {
            $key = 'key';
            Test::run(
                desc: 'Значение сохраняется в пределах сессии (Без перезапуска)',
                test: function () use ($key) {
                    $val = 'val';
                    $this->session->set($key, $val);

                    Test::assertEqual($this->session->get($key), $val);
                }
            );

            Test::run(
                desc: 'Получение значения по умолчанию, если в сесси нет значения по ключу',
                test: function () use ($key) {
                    $val = 'val';

                    Test::assertEqual($this->session->get('_', $val), $val);
                }
            );

            Test::run(
                desc: 'После закрытия сессии данные не доступны',
                test: function () use ($key) {
                    $this->session->commit();
                    Test::assertNull($this->session->get($key));
                }
            );

            Test::run(
                desc: 'Отмена изменений в сессии',
                test: function () use ($key) {
                    $this->session->revert();

                    Test::assertNull($this->session->get($key));
                }
            );
        }
    }
}
