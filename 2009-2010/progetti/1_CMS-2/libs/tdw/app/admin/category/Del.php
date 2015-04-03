<?php

namespace tdw\app\admin\category;

class Del extends \tdw\ApplicationAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-w"))
                        return;

                $category_id = $_POST['category_id'];

                $query = "DELETE
                                FROM categories
                                WHERE id = '{$category_id}'"
                ;

                $result = \mysql_query($query);
        }
}
