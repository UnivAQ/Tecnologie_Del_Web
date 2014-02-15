<?php /* Smarty version 2.6.26, created on 2010-07-06 10:59:59
         compiled from modifica.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type=\'text/javascript\'>
var req;
function loadXMLDoc(key) {
   var url="load_cat.php?id_macrocategoria="+key;
   getObject("com").innerHTML = \' Attendere Prego...\';
   try { req = new ActiveXObject("Msxml2.XMLHTTP"); }
   catch(e) {
      try { req = new ActiveXObject("Microsoft.XMLHTTP"); }
      catch(oc) { req = null; }
   }
   if (!req && typeof XMLHttpRequest != "undefined") { req = new
XMLHttpRequest(); }
   if (req != null) {
      req.onreadystatechange = processChange;
      req.open("GET", url, true);
      req.send(null);
   }
}
function processChange() {
   if (req.readyState == 4 && req.status == 200) {
      getObject("com").innerHTML = req.responseText;
      document.res_request.state.focus();
   }
}

function getObject(name) {
   var ns4 = (document.layers) ? true : false;
   var w3c = (document.getElementById) ? true : false;
   var ie4 = (document.all) ? true : false;

   if (ns4) return eval(\'document.\' + name);
   if (w3c) return document.getElementById(name);
   if (ie4) return eval(\'document.all.\' + name);
   return false;
}
</script>
'; ?>

<a href="prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['id']; ?>
">< Torna al prodotto</a><br /><br />
<h3>Modifica</h3>
<form enctype="multipart/form-data" action="?id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
" method="post">
    <table>
        <tr><td><input type="hidden" name="save" value="1"/></td></tr>
        <tr><td>Titolo:</td> <td><input type="text" name="titolo" value="<?php echo $this->_tpl_vars['prodotto']['titolo']; ?>
" style="width: 435px"/></td></tr>
        <tr><td>Descrizione:</td> <td><textarea name="descrizione" cols="" rows="10" style="width: 435px"><?php echo $this->_tpl_vars['prodotto']['descrizione']; ?>
</textarea></td></tr>
        <tr><td>Categoria:</td> <td>
                <select name="id_macrocategoria" onchange="loadXMLDoc(this.value);" onfocus="loadXMLDoc(this.value);">
                <?php $_from = $this->_tpl_vars['macrocategorie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['macro']):
?>
                <option value="<?php echo $this->_tpl_vars['macro']['id_macrocategoria']; ?>
" <?php if ($this->_tpl_vars['macro']['id_macrocategoria'] == $this->_tpl_vars['prodotto']['id_macrocategoria']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['macro']['nome_macrocategoria']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                </select>
            </td></tr>
        <tr><td>Sottocategoria:</td><td><div id="com"><select name="id_categoria"><option value="<?php echo $this->_tpl_vars['prodotto']['id_categoria']; ?>
"><?php echo $this->_tpl_vars['prodotto']['nome_categoria']; ?>
</option></select></div></td></tr>
        <tr><td>Immagine:</td> <td><input type="file" name="file" style="width: 435px" /></td></tr>
        <tr><td><input type="submit" value="Modifica" /></td></tr>
    </table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>