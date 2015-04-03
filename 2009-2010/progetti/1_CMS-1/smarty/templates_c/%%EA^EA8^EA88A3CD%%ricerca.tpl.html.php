<?php /* Smarty version 2.6.26, created on 2010-07-06 11:24:38
         compiled from ricerca.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Ricerca i prodotti caricati nel sito:<br>
<form action="ricerca.php" method="post" id="ricerca">
    <input type="text" name="q">
    <input type="submit" value="Cerca!">
</form>
<br /><br />
Cerca la recensione del prodotto che ti interessa. Modificala, esprimi un feedback e lascia commenti. <br /><br />
Sei un'azienda? Registrati e pubblica la tua recenzione.
<br /><br />
<?php if ($this->_tpl_vars['oggetti']): ?>


       <div class="productContainer">
      <?php $_from = $this->_tpl_vars['oggetti']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oggetto']):
?>
<div class="pic1"><img src="img.php?id=<?php echo $this->_tpl_vars['oggetto']['id_prodotto']; ?>
" alt="s" width="90" />
    <div class="picText1"><strong><a href="prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['oggetto']['id_prodotto']; ?>
"><?php echo $this->_tpl_vars['oggetto']['titolo']; ?>
</a></strong></div>
            <?php echo $this->_tpl_vars['oggetto']['descrizione']; ?>
...
        </div>
       <?php endforeach; endif; unset($_from); ?>

    </div>

    
<?php else: ?>
<?php if (! $this->_tpl_vars['no_query']): ?>
<h3>Nessun risultato trovato.</h3>
<?php endif; ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>