<?php

namespace tdw\app\cart\product;

class Dec extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isAuthenticated())
                        return;

                $id = $_POST["product"];

                foreach ((array) $_SESSION['cart'] as $key => $product) {
                        if ($product['id'] == $id) {
                                --$_SESSION['cart'][$key]['num'];

                                if ($_SESSION['cart'][$key]['num'] < 1)
                                        unset($_SESSION['cart'][$key]);
                        }
                }

                $this->_setCart();

                return 'blocks/cart';
        }
}
