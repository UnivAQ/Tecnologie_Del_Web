<?php

namespace php;

require_once 'php/Queue.php';

class ActiveQueue extends Queue
{
        public
        function run()
        {
                $args = \func_get_args();

                while ($fn = $this->pop())
                        \call_user_func_array($fn, $args);

                return $this;
        }
}
