<?php

namespace tdw\model;

class Groups extends \php\Object
{
        protected static $_join;

        protected static
        function _normalizeRow($row)
        {
                $row['name'] = \utf8_encode($row['name']);

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
                return self::query("SELECT * FROM groups");
        }

        public static
        function getByOperatorId($id)
        {
                return self::query(
                        "SELECT g.id, g.name
                                FROM groups AS g
                                LEFT JOIN operators_groups AS og
                                        ON g.id = og.group_id
                                WHERE og.operator_id = '{$id}'"
                );
        }
}
