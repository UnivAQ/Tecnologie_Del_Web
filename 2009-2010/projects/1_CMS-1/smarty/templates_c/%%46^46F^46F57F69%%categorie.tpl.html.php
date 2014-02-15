<?php /* Smarty version 2.6.26, created on 2010-07-05 22:55:40
         compiled from categorie.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h2>Categorie</h2><br/>
<?php $_from = $this->_tpl_vars['macrocategorie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['macrocategoria']):
?>
<b><?php echo $this->_tpl_vars['macrocategoria']['macro']; ?>
</b><br>
  <?php $_from = $this->_tpl_vars['macrocategoria']['sotto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
  <a href="sottocategorie.php?id_categoria=<?php echo $this->_tpl_vars['item']['id_categoria']; ?>
"><?php echo $this->_tpl_vars['item']['nome']; ?>
</a><br>
  <?php endforeach; endif; unset($_from); ?>
  <br>
<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>