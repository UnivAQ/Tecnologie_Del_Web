<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

$ds = DIRECTORY_SEPARATOR;
$ps = PATH_SEPARATOR;

/* The project root. */
chdir(dirname(__FILE__)."${ds}..${ds}..");

/* The cwd is no more useful in the include path. */
set_include_path(ltrim(get_include_path(), '.:'));

set_include_path("res{$ds}libs".$ps.get_include_path());
set_include_path('libs'.$ps.get_include_path());

spl_autoload_register(function($class) {
        if (class_exists($class, false) or interface_exists($class, false))
                return;

        $file = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';

        $old = set_error_handler(function() {});

        include_once $file;

        set_error_handler($old);
});

set_error_handler(function($errno, $errstr, $errfile, $errline) {
        print   "Error catched by the app:"
                ."\nMessage = ".$errstr
                ."\nCode = ".$errno
                ."\nFile = ".$errfile
                ."\nLine = ".$errline."\n"
        ;
});

set_exception_handler(function(Exception $exception) {
        print   "Exception catched by the app:"
                ."\nMessage = {\n".$exception->getMessage()."\n}"
                ."\nCode = ".$exception->getCode()
                ."\nFile = ".$exception->getFile()
                ."\nLine = ".$exception->getLine()
                ."\nTrace = ".$exception->getTraceAsString()."\n"
        ;
});

register_shutdown_function (function(){});
