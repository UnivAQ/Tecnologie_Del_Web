<?php

namespace tdw\app\admin\product;

class Add extends \tdw\app\admin\Products
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
                return 'blocks/admin-product-add';
        }

        protected
        function _doPost()
        {
                $operator_id = $this->_auth->get('id');
                $title = \addslashes($_POST["title"]);
                $description = \addslashes($_POST["description"]);
                $price = $_POST["price"];
                $category_id = $_POST["category"];
                $image_type = $_FILES['file']['type'];
                $image = \addslashes(\file_get_contents($_FILES['file']['tmp_name']));

                $sql = "INSERT INTO products (operator_id, title, description, price, image_type, image)
                                VALUES ({$operator_id}, '{$title}', '{$description}', {$price}, '{$image_type}', '{$image}')"
                ;
                $result = \mysql_query($sql);

                $id = \mysql_insert_id();

                $sql = "INSERT INTO products_categories (product_id, category_id)
                                VALUES ({$id}, {$category_id})"
                ;
                $result = \mysql_query($sql);

                parent::_run();

                return 'blocks/admin-products';
        }
}
