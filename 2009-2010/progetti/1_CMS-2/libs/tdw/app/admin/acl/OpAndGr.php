<?php

namespace tdw\app\admin\acl;

class OpAndGr extends \tdw\app\admin\Acl
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-w"))
                        return;

                $operator_id = $_POST['operator_id'];
                $group_id = $_POST['group_id'];

                if (isset($_POST['status'])) {
                        $query = "INSERT INTO operators_groups (operator_id, group_id)
                                VALUES ('{$operator_id}', '{$group_id}')"
                        ;
                        $result = \mysql_query($query);
                } else {
                        $query = "DELETE
                                        FROM operators_groups
                                        WHERE operator_id = '{$operator_id}'
                                               AND group_id = '{$group_id}'"
                        ;
                        $result = \mysql_query($query);
                }
        }
}
