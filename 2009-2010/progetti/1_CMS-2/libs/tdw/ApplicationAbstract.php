<?php

namespace tdw;

abstract class ApplicationAbstract extends \php\Object
{
        protected $_config;

        protected $_smarty;

        protected $_map = array();

        /* DEPRECATED */
        protected $_tpl = array();

        protected $_auth;

        public final
        function __construct(array $config) {
                ob_start();

                if (!$config['debug']) {
                        \error_reporting(0);
                        \ini_set('display_errors', false);
                        \ini_set('display_startup_errors', false);
                }

                $this->_config = $config;

                $this->_setSmarty();
                $this->_setDbConnection();
                $this->_setAuth();
                $this->_setImage();

                if (\method_exists($this, '_init'))
                        $this->_init();

                $return = $this->_run();

                if ($return) {
                        $redirect = \substr($return, 0, \strlen($r="redirect:"))
                                        ==
                                    $r
                       ;
                        if ($redirect) {
                                $target = \substr($return, \strlen($r));

                                header("Location: {$target}");
                        } else {
                                $view = $this->_render($return);

                                $view .= \ob_get_contents();
                                \ob_clean();

                                echo $view;
                        }
                }

                $view = \ob_get_contents();
                \ob_clean();

                if ($this->_config['compression.active']) {
                        \header('Content-Encoding: gzip');
                        $view = \gzencode($view, 6, \FORCE_GZIP);
                }

                echo $view;

                ob_end_flush();
        }

        public
        function __destruct()
        {}

        protected
        function _render($view)
        {
                //header('Content-Type: application/xhtml+xml; charset=UTF-8');
                header('Content-Type: text/html; charset=UTF-8');

                return $this->_smarty->fetch($view . '.tpl');
        }

        private
        function _setSmarty()
        {
                $ds = \DIRECTORY_SEPARATOR;

                require_once 'Smarty/Smarty.class.php';

                $smarty = new \Smarty();

                //$smarty->allow_php_templates = true;
                $smarty->cache_dir = "res{$ds}smarty{$ds}cache";
                $smarty->config_dir = "res{$ds}smarty{$ds}config";
                $smarty->template_dir = "res{$ds}tpl";
                $smarty->compile_dir = "res{$ds}smarty{$ds}template_c";
                $smarty->left_delimiter = '%{ ';
                $smarty->right_delimiter = ' }%';
                //$smarty->compile_id      = $this->_request->getServerDomain();
                //$smarty->use_sub_dirs    = true;
                $smarty->security = false;
                //$smarty->secure_dir      = array(0 => ..., 1 => ...);
                //$smarty->trusted_dir     = array();
                $smarty->caching = false;
                //$smarty->cache_lifetime  = 0;
                //$smarty->compile_check   = true;
                //$smarty->force_compile   = true;
                //$smarty->debugging       = true;
                //$smarty->utility->clearCompiledTemplate();
                //$smarty->cache->clearAll();
                //$smarty->clear_compiled_tpl();
                //$smarty->clear_all_cache();

                $smarty->assign_by_ref('_', $this->_map);

                /* CONTINGENT */
                /*
                $this->_map = & $this->_map;
                $smarty->assign_by_ref('tpl', $this->_map);
                */

                $this->_smarty = $smarty;
        }

        private
        function _setDbConnection()
        {
                \mysql_select_db($this->_config['dbms.db'], \mysql_connect(
                        $this->_config['dbms.host'],
                        $this->_config['dbms.user'],
                        $this->_config['dbms.pass']
                ));
        }

        private
        function _setAuth()
        {
                $this->_auth = \tdw\helper\Auth::_new_();
                $this->_map['auth'] = $this->_auth->get();
                $this->_map['auth']['isadmin'] = $this->_auth->isCapableOf("admin-r");
        }

        private
        function _setImage()
        {
                $this->_image = \tdw\helper\Image::_new_(
                        $this->_config['img.dir'],
                        $this->_config['img.prefix']
                );
        }

        abstract protected function _run();
}
