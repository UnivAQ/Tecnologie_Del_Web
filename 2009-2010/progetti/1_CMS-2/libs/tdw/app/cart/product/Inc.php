<?php

namespace tdw\app\cart\product;

class Inc extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isAuthenticated())
                        return;

                $id = $_POST["product"];

                foreach ((array) $_SESSION['cart'] as $key => $product) {
                        if ($product['id'] == $id) {
                                ++$_SESSION['cart'][$key]['num'];
                        }
                }

                $this->_setCart();

                return 'blocks/cart';
        }
}
