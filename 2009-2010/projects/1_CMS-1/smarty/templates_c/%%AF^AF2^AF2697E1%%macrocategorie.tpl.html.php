<?php /* Smarty version 2.6.26, created on 2010-07-05 22:55:16
         compiled from macrocategorie.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2>Macrocategoria</h2><br/>
<b><?php echo $this->_tpl_vars['macro']['nome_macrocategoria']; ?>
</b><br>
<?php $_from = $this->_tpl_vars['macro']['categorie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categoria']):
?>
<a href="sottocategorie.php?id_categoria=<?php echo $this->_tpl_vars['categoria']['id_categoria']; ?>
"><?php echo $this->_tpl_vars['categoria']['nome_categoria']; ?>
</a><br>
  <?php endforeach; endif; unset($_from); ?>
  <br>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>