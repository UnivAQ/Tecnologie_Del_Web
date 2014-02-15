<?php /* Smarty version 2.6.26, created on 2010-07-05 23:50:30
         compiled from add_specifiche.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">
var counter = 1;
function addInput(divName){

          var newdiv = document.createElement(\'div\');
          newdiv.innerHTML = "<input type=\'text\' name=\'denominazione[]\'> Denominazione<br /> <input type=\'text\' name=\'valore[]\'> Valore<br /><br />";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
}
</script>
'; ?>

<a href="prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['id']; ?>
">< Torna al prodotto</a><br /><br />
<b>AGGIUNGI SPECIFICHE</b><br /><br />
<form method="POST" action="">
    <input type="hidden" name="save" value="1"/>
    <input type="hidden" name="id_prodotto" value="<?php echo $this->_tpl_vars['id_prodotto']; ?>
"/>
    <div id="dynamicInput">
    <input type="text" name="denominazione[]"/> Denominazione<br /> <input type="text" name="valore[]"/> Valore<br /><br />
    </div><br />
    <input type="button" value="Aggiungi un altro input" onClick="addInput('dynamicInput');"/>
    <input type="submit" value="Via!"/>
    </form>

<br /><br /><b>LISTA SPECIFICHE</b><br /><br /><br />
<table>
<?php if ($this->_tpl_vars['spec']): ?>
<?php $_from = $this->_tpl_vars['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['specifiche']):
?>

    <tr><td><?php echo $this->_tpl_vars['specifiche']['denominazione']; ?>
:</td> <td><?php echo $this->_tpl_vars['specifiche']['valore']; ?>
</td> <td><a class="img" href="?id_prodotto=<?php echo $this->_tpl_vars['id_prodotto']; ?>
&delete&id_specifica=<?php echo $this->_tpl_vars['specifiche']['id_specifica']; ?>
"><img class="ico" alt="delete" src="./template/images/delete.png" /></a></td></tr>

<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
Nessun hai inserito alcuna specifica
<?php endif; ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>