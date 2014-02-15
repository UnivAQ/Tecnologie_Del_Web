<?php

namespace tdw\app\admin\product;

class Search extends \tdw\app\admin\Products
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("publish"))
                        return;

                $products = \tdw\model\Products::search(
                        $_GET['query'],
                        $this->_auth->get('id')
                );

                $this->_map['products'] = $this->_useImages($products);

                return 'blocks/admin-products';
        }
}
