<?php

namespace tdw\app;

class Admin extends \tdw\ApplicationAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-r"))
                        return 'redirect:/';

                return 'admin';
        }
}
