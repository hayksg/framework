<?php

// Front Controller

// 1. Settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Including system files
define('ROOT', __DIR__ . '/../');
require_once(ROOT . 'Components/Router.php');

// 3. Connecting to DB

// 4. Router's call
$router = new Router;
$router->run();
