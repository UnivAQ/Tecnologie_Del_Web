<?php

namespace tdw\model;

class Products extends \php\Object
{
        protected static $_join =
                "SELECT p.*, g.name AS 'category', g.id AS 'category_id'
                        FROM products AS p
                        LEFT JOIN products_categories AS c
                                ON p.id = c.product_id
                        LEFT JOIN categories AS g
                                ON c.category_id = g.id";

        protected static
        function _normalizeRow($row)
        {
                $row['title'] = \utf8_encode($row['title']);
                $row['description'] = \utf8_encode($row['description']);
                $row['image_type'] = \substr($row['image_type'], 6);
                $row['category'] = \utf8_encode($row['category']);

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
        function getById($id)
        {
                $products = self::query(self::$_join
                        ." WHERE p.id = '{$id}'"
                );

                return $products[0];
        }

        public static
        function getByCategoryId($id)
        {
                return self::query(self::$_join
                        ." WHERE c.category_id = {$id}"
                );
        }

        public static
        function getByOperatorId($id)
        {
                return self::query(self::$_join
                        ." WHERE operator_id = '{$id}'
                                ORDER BY id DESC"
                );
        }

        public static
        function search($query, $oid = null)
        {
                return self::query(self::$_join
                        ." WHERE (
                                title LIKE '%{$query}%'
                                OR description LIKE '%{$query}%'
                        )".($oid ? " AND operator_id = '{$oid}'" : '')
                        ." ORDER BY p.id DESC"
                );
        }
}
