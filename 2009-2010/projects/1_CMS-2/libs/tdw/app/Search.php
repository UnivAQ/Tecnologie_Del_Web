<?php

namespace tdw\app;

class Search extends HomeAbstract
{
        protected
        function _run()
        {
                $products = \tdw\model\Products::search(
                        $_GET['query']
                );

                $this->_map['products'] = $this->_useImages($products);
                $this->_map['products_count'] = \count($products);

                return 'products';
        }
}
