<?php

namespace tdw\helper;

use \tdw\model\Capabilities;
use \tdw\model\Operators;

class Auth extends \php\Object
{
        protected
        $_data = array();

        public
        function __construct()
        {
                session_start();

                if (isset($_SESSION['auth'])) {
                        $uid = $_SESSION['auth']['uid'];

                        $operator = Operators::getByUid($uid);
                        $operator['capabilities'] = \array_map(
                                function($value) {
                                        return $value['name'];
                                },
                                Capabilities::getByOperatorId(
                                        $operator['id']
                                )
                        );
                        $_SESSION['auth'] = $this->_data = $operator;
                }

                if (isset($_POST['signin'])
                    and isset($_POST['uid'])
                    and isset($_POST['pass'])) {
                        $uid = $_POST['uid'];
                        $pass = $_POST['pass'];

                        $operator = Operators::getByUid($uid);
                        if ($operator['pass'] == \md5($pass)) {
                                $operator['capabilities'] = \array_map(
                                        function($value) {
                                                return $value['name'];
                                        },
                                        Capabilities::getByOperatorId(
                                                $operator['id']
                                        )
                                );
                                $_SESSION['auth'] = $this->_data = $operator;
                        }
                }

                if (isset($_GET['signout'])) {
                        $_SESSION = $this->_data = array();
                }
        }

        public
        function __destruct()
        {
                \session_write_close();
        }

        public
        function get($entry = null)
        {
                if ($entry == null)
                        return $this->_data;

                return $this->_data[$entry];
        }

        public
        function isAuthenticated()
        {
                return isset($this->_data['id']);
        }

        public
        function isCapableOf($capability)
        {
                return $this->isAuthenticated()
                        and \in_array($capability, $this->_data['capabilities'])
                ;
        }
}
