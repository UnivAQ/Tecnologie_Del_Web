<?php

namespace tdw\app\admin;

class Categories extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-r"))
                        return 'redirect:/';

                return 'admin.categories';
        }
}
