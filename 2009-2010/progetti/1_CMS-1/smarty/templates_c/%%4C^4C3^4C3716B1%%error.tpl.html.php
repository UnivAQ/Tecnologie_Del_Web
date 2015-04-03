<?php /* Smarty version 2.6.26, created on 2010-07-05 23:35:08
         compiled from error.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['errore'] == -1): ?>
	Security ERROR! Questo prodotto non ti appartiene
<?php elseif ($this->_tpl_vars['ettore'] == 1): ?>
	Errore permessi
<?php else: ?>
	Errore permessi
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>