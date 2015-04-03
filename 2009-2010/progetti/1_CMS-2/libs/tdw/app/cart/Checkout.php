<?php

namespace tdw\app\cart;

use \tdw\model\Operators;

class Checkout extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isAuthenticated())
                        return 'redirect:/';

                if ($_SERVER['REQUEST_METHOD'] == "POST")
                        return $this->_doPost();

                return $this->_doGet();
        }

        protected
        function _doGet()
        {
                $this->_map['operator'] = Operators::getInfoById(
                        $this->_auth->get('id')
                );

                return "checkout";
        }

        protected
        function _doPost()
        {
                $_SESSION['cart'] = array();
                $this->_setCart();

                return "checkout-post";
        }
}
