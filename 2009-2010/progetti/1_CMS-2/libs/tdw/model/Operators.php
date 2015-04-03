<?php

namespace tdw\model;

class Operators extends \php\Object
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
                return self::query("SELECT id, uid FROM operators");
        }

        public static
        function getByUid($uid)
        {
                $operators = self::query("SELECT * FROM operators WHERE uid = '{$uid}'");

                return $operators[0];
        }

        public static
        function getInfoById($id)
        {
                $operators = self::query(
                        "SELECT o.*,
                                i.name,
                                i.surname,
                                i.email,
                                i.address,
                                i.cap,
                                i.city,
                                i.province,
                                i.state,
                                i.telephone
                                FROM operators AS o
                                LEFT JOIN operators_infos AS i
                                        ON o.id = i.operator_id
                                WHERE o.id = '{$id}'"
                );

                return $operators[0];
        }
}
