<?php

function appAutoload($class)
{
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    $segments = explode('\\', $class);

    $className = array_pop($segments);
    $pathPart = array_shift($segments) . DS . array_shift($segments);

    if ($pathPart == 'Application' . DS . 'Components') {
        $path = ROOT . 'Application' . DS . 'Components' . DS;
    } elseif ($pathPart == 'Application' . DS . 'Controller') {
        $path = ROOT . 'Application' . DS . 'Controller' . DS;
    } elseif ($pathPart == 'Application' . DS . 'Model') {
        $path = ROOT . 'Application' . DS . 'Model' . DS;
    }

    $file = $path . $className . '.php';

    if (is_file($file)) {
        include_once($file);
    }
}

spl_autoload_register('appAutoload');
