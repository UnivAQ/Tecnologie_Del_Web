<?php

namespace tdw\app;

abstract class HomeAbstract extends \tdw\ApplicationAbstract
{
        protected $_image;

        protected
        function _init()
        {
                $this->_setProductCategories();
                $this->_setCart();
        }

        protected
        function _setProductCategories()
        {
                $query = \mysql_query(
                        "SELECT * FROM categories"
                );

                $this->_map['categories'] = array();
                while ($row = \mysql_fetch_assoc($query)) {
                        $row['name'] = \utf8_encode($row['name']);
                        $this->_map['categories'][] = $row;
                }
        }

        protected
        function _setCart()
        {
                $this->_map['cart'] =& $_SESSION['cart'];

                $total = 0;
                foreach ((array) $_SESSION['cart'] as $key => $product) {
                        $total += $product['num'] * $product['price'];
                }
                $_SESSION['cart_total'] = $total;
                $this->_map['cart_total'] =& $_SESSION['cart_total'];

                $productsCount = 0;
                foreach ((array) $_SESSION['cart'] as $key => $product) {
                        $productsCount += $product['num'];
                }
                $this->_map['cart_products_count'] = $productsCount;
        }

        protected
        function _useImages(array $products)
        {
                foreach ($products as $key => &$product) {
                        $product['image'] = $this->_image->publicate(
                                $product['image'],
                                $product['image_type']
                        );
                }

                return $products;
        }
}
