<?php

namespace tdw\app\cart;

class Reset extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isAuthenticated())
                        return;

                $_SESSION['cart'] = array();
                $this->_setCart();

                return 'blocks/cart';
        }
}
