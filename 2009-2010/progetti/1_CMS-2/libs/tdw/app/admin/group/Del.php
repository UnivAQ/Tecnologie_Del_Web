<?php

namespace tdw\app\admin\group;

class Del extends \tdw\ApplicationAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-w"))
                        return;

                $group_id = $_POST['group_id'];

                $query = "DELETE
                                FROM groups
                                WHERE id = '{$group_id}'"
                ;

                $result = \mysql_query($query);
        }
}
