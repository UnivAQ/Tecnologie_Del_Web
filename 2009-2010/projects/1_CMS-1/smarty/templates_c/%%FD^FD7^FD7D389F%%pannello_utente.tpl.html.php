<?php /* Smarty version 2.6.26, created on 2010-07-05 22:56:03
         compiled from pannello_utente.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
<h2>Pannello Utente</h2>
<h3>Benvenuto <?php echo $this->_tpl_vars['username']; ?>
</h3>
<?php if ($this->_tpl_vars['servizio_2']): ?>

               <h3> Inserimento nuovo prodotto<a href="inserimento_prodotto.php"> <img src="./template/images/plus.png" style="border: none" width="15"/></a></h3>
                        <?php endif; ?>

                        
                       

                        <table>

                        <?php if ($this->_tpl_vars['prodotto']): ?>
                        <tr><td>I MIEI OGGETTI</td></tr>
                        <?php $_from = $this->_tpl_vars['prodotto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prodotti']):
?>
                        <tr><td><a href="prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['prodotti']['id_prodotto']; ?>
"><?php echo $this->_tpl_vars['prodotti']['titolo']; ?>
</a></td>  <td><a href="modifica.php?id_prodotto=<?php echo $this->_tpl_vars['prodotti']['id_prodotto']; ?>
"><img class="ico" alt="modifica" src="./template/images/modifica.png" /></a></td> <td><a href="add_specifiche.php?id_prodotto=<?php echo $this->_tpl_vars['prodotti']['id_prodotto']; ?>
"><img class="ico" alt="specifiche" src="./template/images/specifiche.gif"/></a></td></tr>

                        <?php endforeach; endif; unset($_from); ?>
                        <?php else: ?>
                        <?php if ($this->_tpl_vars['servizio_2']): ?>
                        Nessun hai inserito alcun prodotto
                        <?php endif; ?>
                        <?php endif; ?>

                        </table>
                     <div class="clear"></div>
            
           
            <div class="clear"></div>
          
          <div class="clear"></div>
           <div class="clear"></div>
  
 



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>