<?php

namespace tdw\helper;

class Image extends \php\Object
{
        protected $_dir = './img/';

        protected  $_prefix = '/img/';

        public
        function __construct($dir = null, $prefix = null)
        {
                if ($dir)
                        $this->_dir = $dir;

                if ($prefix)
                        $this->_prefix = $prefix;
        }

        public
        function publicate($payload, $type)
        {
                $hash = \md5($payload);

                $file = \str_replace('/', \DIRECTORY_SEPARATOR, $this->_dir)
                        ."{$hash}.{$type}"
                ;
                if (!\is_readable($file)) {
                        if (! \is_dir($dir = \dirname($file)))
                                \mkdir($dir, 0770, true);

                        \file_put_contents($file, $payload);
                }

                return $this->_prefix."{$hash}.{$type}";
        }
}
