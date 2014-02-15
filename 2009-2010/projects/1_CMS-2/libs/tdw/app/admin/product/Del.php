<?php

namespace tdw\app\admin\product;

class Del extends \tdw\app\admin\Products
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("publish"))
                        return;

                $operator_id = $this->_auth->get('id');
                $product_id  = $_POST['product_id'];

                \mysql_query("DELETE FROM products WHERE id = {$product_id}");

                parent::_run();

                return 'blocks/admin-products';
        }
}
