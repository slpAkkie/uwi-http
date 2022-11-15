<?php

use TestModule\Test;

class HttpModuleUnitTest
{
    /**
     * Array of tests in the order in which they should be run.
     *
     * @var array<string>
     */
    protected array $testClasses = [
        SessionUnitTest::class,
        CookieUnitTest::class,
        RequestUnitTest::class,
        ResponseUnitTest::class,
        RoutingUnitTest::class,
    ];

    protected array $testObjects = [];

    public function __construct()
    {
        Test::enableOutputBuffering();
        foreach ($this->testClasses as $testClass) {
            $this->testObjects[$testClass] = new $testClass;
        }
    }

    public function all(): void
    {
        foreach ($this->testClasses as $testClass) {
            $this->testObjects[$testClass]->all();
        }
        Test::printCleanBuffer();
    }
}
