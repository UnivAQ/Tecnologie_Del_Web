<?php

namespace tdw\app;

class Product extends HomeAbstract
{
        protected
        function _run()
        {
                $product = \tdw\model\Products::getById(
                        $_GET['id']
                );

                $this->_map['product'] = $this->_useImages(array($product));
                $this->_map['product'] = $this->_map['product'][0];

                return 'product';
        }
}
