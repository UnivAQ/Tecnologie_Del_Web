<?php

namespace tdw\app\admin;

use \tdw\model\Capabilities;
use \tdw\model\Groups;
use \tdw\model\Operators;

class Acl extends \tdw\ApplicationAbstract
{
        protected
        function _run()
        {
                if (! $this->_auth->isCapableOf("admin-r"))
                        return 'redirect:/';

                $operators    = Operators::getAll();
                $groups       = Groups::getAll();
                $capabilities = Capabilities::getAll();

                $this->_map['operators'] = $operators;
                foreach ($this->_map['operators'] as &$o) {
                        $o['groups'] = $groups;

                        foreach (Groups::getByOperatorId($o['id']) as $g) {
                                $key = \array_search($g, $o['groups']);
                                if ($key !== false) {
                                        $o['groups'][$key]['checked'] = true;
                                }
                        }
                }

                $this->_map['groups'] = $groups;
                foreach ($this->_map['groups'] as &$g) {
                        $g['capabilities'] = $capabilities;

                        foreach (Capabilities::getByGroupId($g['id']) as $c) {
                                $key = \array_search($c, $g['capabilities']);
                                if ($key !== false) {
                                        $g['capabilities'][$key]['checked'] = true;
                                }
                        }
                }

                return 'admin.acl';
        }
}
