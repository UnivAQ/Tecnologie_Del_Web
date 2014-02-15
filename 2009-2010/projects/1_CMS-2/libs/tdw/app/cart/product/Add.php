<?php

namespace tdw\app\cart\product;

class Add extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isAuthenticated())
                        return;

                $id    = $_POST["product"];
                $num   = $_POST["quantity"];

                if (! $num)
                        return 'cart.products';

                $exists = false;

                foreach ((array) $_SESSION['cart'] as $key => $product) {
                        if ($product['id'] == $id) {
                                $_SESSION['cart'][$key]['num'] += $num;
                                $exists = true;
                        }
                }

                if (! $exists) {
                        $title = \mysql_fetch_assoc(\mysql_query(
                                "SELECT title, price FROM products WHERE id = {$id}"
                        ));

                        $_SESSION['cart'][] = array(
                                'id' => $id,
                                'num' => $num,
                                'title' => $title['title'],
                                'price' => $title['price'],
                        );
                }

                $this->_setCart();

                return 'blocks/cart';
        }
}
