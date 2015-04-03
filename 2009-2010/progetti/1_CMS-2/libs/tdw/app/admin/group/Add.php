<?php

namespace tdw\app\admin\group;

class Add extends \tdw\ApplicationAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-w"))
                        return;

                $group = $_POST['group'];

                $query = "INSERT INTO groups (name)
                                VALUES ('{$group}')"
                ;
                $result = \mysql_query($query);

                $id = \mysql_insert_id();

                $this->_map['group'] = array(
                    'id' => $id,
                    'name' => $group
                );

                return 'blocks/admin-acl-group';
        }
}
