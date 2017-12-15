<?php

use Application\Components\Router;

// Front Controller

// Settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Including system files
define('ROOT', __DIR__ . '/../');

//require_once(ROOT . 'Components/Router.php');
//require_once(ROOT . 'Components/DB.php');

require_once(ROOT . 'config/autoload.php');

// Router's call
$router = new Router;
$router->run();
