<?php /* Smarty version 2.6.26, created on 2010-07-05 23:32:11
         compiled from index.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class="tunesBox">
    <h1>Hi Tech Review</h1>
    
    <span class="boldText"> Ricerca i prodotti caricati nel sito:</span><br /><br />
<form action="ricerca.php" method="post" id="ricerca">
    <input type="text" name="q">
    <input type="submit" value="Cerca!">
</form> </div>
<div class="rightCd"> <img src="./template/images/sd.jpg" alt="s" /> </div>
<div class="clear"></div>
<div class="rightBox2">
    <br/>
    <h1>Alcuni Prodotti:</h1>
    <div class="productContainer">
        <?php if ($this->_tpl_vars['oggetti']): ?>
<?php $_from = $this->_tpl_vars['oggetti']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oggetto']):
?>
<div class="pic1"><img src="img.php?id=<?php echo $this->_tpl_vars['oggetto']['id_prodotto']; ?>
" alt="s" width="100" />
    <div class="picText1"><strong><a href="prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['oggetto']['id_prodotto']; ?>
"><?php echo $this->_tpl_vars['oggetto']['titolo']; ?>
</a></strong></div>
            <?php echo $this->_tpl_vars['oggetto']['descrizione']; ?>
...
        </div>
       <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
    </div>
    <div class="clear"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>