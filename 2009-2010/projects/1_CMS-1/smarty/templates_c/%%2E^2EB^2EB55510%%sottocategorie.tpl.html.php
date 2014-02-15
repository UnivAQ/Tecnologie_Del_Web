<?php /* Smarty version 2.6.26, created on 2010-07-05 22:55:09
         compiled from sottocategorie.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h2>Sottocategoria</h2><br/>
<a href="macrocategorie.php?id_macrocategoria=<?php echo $this->_tpl_vars['categoria']['id_macrocategoria']; ?>
"><?php echo $this->_tpl_vars['categoria']['nome_macrocategoria']; ?>
</a>  >  <a href="sottocategorie.php?id_categoria=<?php echo $this->_tpl_vars['categoria']['id_categoria']; ?>
"><?php echo $this->_tpl_vars['categoria']['nome_categoria']; ?>
</a><br /><br />




 <div class="productContainer">
     
<?php if ($this->_tpl_vars['categoria']['prodotto']): ?>
<?php $_from = $this->_tpl_vars['categoria']['prodotto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prodotto']):
?>
<div class="pic1"><img src="img.php?id=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
" alt="s" width="100" />
    <div class="picText1"><strong><a href="prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"><?php echo $this->_tpl_vars['prodotto']['titolo']; ?>
</a></strong></div>
            <?php echo $this->_tpl_vars['prodotto']['descrizione']; ?>
...
        </div>
       <?php endforeach; endif; unset($_from); ?>

    </div>
<?php else: ?>
Nessun prodotto nella categoria
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>