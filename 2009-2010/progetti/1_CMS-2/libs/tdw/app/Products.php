<?php

namespace tdw\app;

class Products extends HomeAbstract
{
        protected
        function _run()
        {
                $products = \tdw\model\Products::getByCategoryId(
                        $_GET['id']
                );

                $this->_map['products'] = $this->_useImages($products);
                $this->_map['products_count'] = \count($this->_map['products']);

                return 'products';
        }
}
