<?php

namespace tdw\app\cart\product;

class Set extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isAuthenticated())
                        return;

                $id  = $_POST["product"];
                $num = $_POST["quantity"];

                foreach ((array) $_SESSION['cart'] as $key => $product) {
                        if ($product['id'] == $id) {
                                if ($num < 1)
                                        unset($_SESSION['cart'][$key]);
                                else
                                        $_SESSION['cart'][$key]['num'] = $num;
                        }
                }

                $this->_setCart();

                return 'blocks/cart';
        }
}
