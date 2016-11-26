<?php

define("SDK_DIR", dirname(__FILE__) . "/");

function __autoload($class_name)
{
    if (strpos($class_name, "Exception")) {
        $class_file = SDK_DIR . "exceptions/{$class_name}.php";
    } else if (is_file(SDK_DIR . "apis/{$class_name}.php")) {
        $class_file = SDK_DIR . "apis/{$class_name}.php";
    } else if (is_file(SDK_DIR . "oauth/{$class_name}.php")) {
        $class_file = SDK_DIR . "oauth/{$class_name}.php";
    } else if (is_file(SDK_DIR . "protocol/{$class_name}.php")) {
        $class_file = SDK_DIR . "protocol/{$class_name}.php";
    } else if (is_file(SDK_DIR . "apis/entity/${class_name}.php")) {
        $class_file = SDK_DIR . "apis/entity/${class_name}.php";
    } else {
        $class_file = SDK_DIR . "{$class_name}.php";
    }

    if (is_file($class_file) && !class_exists($class_name)) {
        require($class_file);
    }
}

set_error_handler(function ($errno, $error_str, $error_file, $error_line, array $errcontext) {
    throw new ErrorException($error_str, 0, $errno, $error_file, $error_line);
});

