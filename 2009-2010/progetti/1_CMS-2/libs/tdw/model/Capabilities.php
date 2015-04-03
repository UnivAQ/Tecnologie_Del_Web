<?php

namespace tdw\model;

class Capabilities extends \php\Object
{
        protected static $_join;

        protected static
        function _normalizeRow($row)
        {
                return $row;
        }

        public static
        function query($query)
        {
                $query = \mysql_query($query);

                $rows = array();
                while ($row = \mysql_fetch_assoc($query)) {
                        $rows[] = self::_normalizeRow($row);
                }

                return $rows;
        }

        public static
        function getAll()
        {
                return self::query("SELECT * FROM capabilities");
        }

        public static
        function getByGroupId($id)
        {
                return self::query(
                        "SELECT c.id, c.name
                                FROM capabilities AS c
                                LEFT JOIN groups_acl AS ga
                                        ON c.id = ga.capability_id
                                WHERE ga.group_id = '{$id}'"
                );
        }

        public static
        function getByOperatorId($id)
        {
                return self::query(
                        "SELECT c.name
                                FROM operators_groups AS g
                                LEFT JOIN groups_acl AS a
                                        ON g.group_id = a.group_id
                                LEFT JOIN capabilities AS c
                                        ON a.capability_id = c.id
                                WHERE operator_id = '{$id}'"
                );
        }
}
