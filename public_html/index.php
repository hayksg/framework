<?php

use Application\Components\Router;
use Application\Components\FunctionsLibrary;

// Front Controller

// Settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Including system files
define('ROOT', __DIR__ . '/../');
require_once(ROOT . 'config/autoload.php');

// Handling errors
set_exception_handler([new FunctionsLibrary, 'catchAllExceptions']);

// Router's call
$router = new Router;
$router->run();


