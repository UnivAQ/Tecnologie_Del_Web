<?php

return array(
        'debug' => true,
        'compression.active' => true,
        'dbms.host' => 'localhost',
        'dbms.db'   => 'tecweb',
        'dbms.user' => 'tecweb',
        'dbms.pass' => 'tecweb',
        'img.dir'    => './pub/img/db/',
        'img.prefix' => '/img/db/'
);

// CREATE DATABASE tecweb;
// CREATE USER 'tecweb'@'%' IDENTIFIED BY 'tecweb';
// GRANT ALL PRIVILEGES ON *.* TO 'tecweb'@'%' IDENTIFIED BY 'tecweb' WITH GRANT OPTION;
