<?php

namespace php;

require_once 'php/Object.php';

class Queue extends Object
{
        protected
        $_queue = array();

        public
        function __construct($elements = array())
        {
                foreach ((array) $elements as $element)
                        $this->push($element);
        }

        public
        function push($element)
        {
                $this->_queue[] = $element;

                return $this;
        }

        public
        function pop()
        {
                if (empty($this->_queue))
                        return null;

                return \array_shift($this->_queue);
        }
}
