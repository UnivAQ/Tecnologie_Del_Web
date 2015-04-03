<?php

require_once 'setting.php';

$ds = DIRECTORY_SEPARATOR;

preg_match('/[^?]+/', $_SERVER['REQUEST_URI'], $matches);
$request = array_pop($matches);

$app = 'tdw/app';

$app .= $request == '/' ?
                '/index'
        :       rtrim($request, '/')
;

$app = str_replace('-', '_', $app);

$app = dirname($app).'/'.ucfirst(basename($app));

/* Windows compliance. */
if (! is_file("libs{$ds}".str_replace('/', $ds, $app).'.php'))
        $app = 'tdw/app/Code404';

$app = str_replace('/', '\\', $app);

$app::_new_(require 'tdw/config.php');
