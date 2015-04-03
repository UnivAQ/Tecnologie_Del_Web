<?php

namespace tdw\app\admin;

class Products extends \tdw\app\HomeAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf('publish'))
                        return 'redirect:/';

                $products = \tdw\model\Products::getByOperatorId(
                        $this->_auth->get('id')
                );

                foreach ($products as &$product) {
                        $product['description'] = \htmlspecialchars($product['description']);
                }

                $this->_map['products'] = $this->_useImages($products);

                if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                    and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
                        return 'blocks/admin-products';

                return 'admin.products';
        }
}
