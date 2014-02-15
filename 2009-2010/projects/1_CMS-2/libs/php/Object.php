<?php

namespace php;

class Object extends \stdClass
{
        public static
        function _new_()
        {
                $class = \get_called_class();

                $args = \func_get_args();

                if ($args) {
                        $cls = new \ReflectionClass($class);
                        $instance = $cls->newInstanceArgs($args);

                } else /* This code is faster than the reflection. */
                        $instance = new $class();

                return $instance;
        }

        public
        function _clone_()
        {
                return clone $this;
        }
}
