<?php

namespace tdw\app\admin\category;

class Add extends \tdw\app\admin\Categories
{
        protected
        function _run()
        {
                if (!$this->_auth->isCapableOf("admin-w"))
                        return;

                if ($_SERVER['REQUEST_METHOD'] == "POST")
                        return $this->_doPost();

                return $this->_doGet();
        }

        protected
        function _doGet()
        {
                return 'blocks/admin-categories-add';
        }

        protected
        function _doPost()
        {
                if (!$this->_auth->isCapableOf("admin-w"))
                        return;

                $category_id = $_POST["category"];
                
                $sql = "INSERT INTO categories (name) VALUES ('{$category_id}')";
                $result = \mysql_query($sql);

                $this->_setProductCategories();

                return 'blocks/admin-categories';
        }
}
