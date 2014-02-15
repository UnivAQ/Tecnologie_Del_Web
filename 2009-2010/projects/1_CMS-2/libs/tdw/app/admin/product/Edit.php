<?php

namespace tdw\app\admin\product;

class Edit extends \tdw\app\admin\Products
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("publish"))
                        return;

                if ($_SERVER['REQUEST_METHOD'] == "POST")
                        return $this->_doPost();

                return $this->_doGet();
        }

        protected
        function _doGet()
        {
                $product_id = $_GET['id'];

                $product = \tdw\model\Products::getById(
                        $_GET['id']
                );

                foreach ($this->_map['categories'] as $key => &$category) {
                        if ($category['name'] == $product['category']) {
                                $category['checked'] = true;
                        }
                }

                $this->_map['product'] = $this->_useImages(array($product));
                $this->_map['product'] = $this->_map['product'][0];

                return 'blocks/admin-product-edit';
        }

        protected
        function _doPost()
        {
                $product_id = $_GET['id'];

                $mod = false;
                $query = '';

                $q = "UPDATE products SET ";

                if (isset($_POST["title"])) {
                        $query .= $q;
                        $mod = true;
                        $v = \addslashes(\utf8_decode($_POST['title']));
                        $query .= "title = '{$v}'";
                }

                if (isset($_POST["description"])) {
                        if (! $mod) {
                                $query .= $q;
                                $mod = true;
                        } else {
                                $query .= ', ';
                        }
                        $v = \addslashes(\utf8_decode($_POST['description']));
                        $query .= "description = '{$v}'";
                }

                if (isset($_POST["price"])) {
                        if (! $mod) {
                                $query .= $q;
                                $mod = true;
                        } else {
                                $query .= ', ';
                        }
                        $query .= "price = '{$_POST['price']}'";
                }

                $query .= " WHERE id = '{$product_id}'";

                $result = \mysql_query($query);

                if (isset($_POST["category"])) {
                        $query = "UPDATE products_categories
                                        SET category_id = '{$_POST['category']}'
                                        WHERE product_id = '{$product_id}'"
                        ;
                        $result = \mysql_query($query);
                }

                parent::_run();

                return 'blocks/admin-products';
        }
}
