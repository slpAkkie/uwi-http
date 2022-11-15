<?php

define('APP_ROOT_PATH', __DIR__);

require_once APP_ROOT_PATH . '/TestModule/options.php';
require_once APP_ROOT_PATH . '/Autoload/Initializer.php';



if (php_sapi_name() === 'cli') {
    (new HttpModuleUnitTest())->all();
} else {
    require_once APP_ROOT_PATH . '/web.php';
}
