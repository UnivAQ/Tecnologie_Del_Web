<?php

namespace tdw\app\admin\acl;

class GrAndCa extends \tdw\app\admin\Acl
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-w"))
                        return;

                $group_id = $_POST['group_id'];
                $capability_id = $_POST['capability_id'];

                if (isset($_POST['status'])) {
                        $query = "INSERT INTO groups_acl (group_id, capability_id)
                                VALUES ('{$group_id}', '{$capability_id}')"
                        ;
                        $result = \mysql_query($query);
                } else {
                        $query = "DELETE
                                        FROM groups_acl
                                        WHERE group_id = '{$group_id}'
                                               AND capability_id = '{$capability_id}'"
                        ;
                        $result = \mysql_query($query);
                }
        }
}
