<?php

spl_autoload_register(function ($class)
{
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    require $path;
});


/*function my_app_autoload($class)
{

    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($path))
        include $path;


}


spl_autoload_register('my_app_autoload');

spl_autoload_register(function ($class) {
    include __DIR__ . '/' . str_replace(['\\','App'], ['/', 'lib'], $class) . '.php';

});*/