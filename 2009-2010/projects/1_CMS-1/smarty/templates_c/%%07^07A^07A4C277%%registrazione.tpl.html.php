<?php /* Smarty version 2.6.26, created on 2010-07-06 10:57:29
         compiled from registrazione.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['tipo'] == 'utente'): ?>
<h2>Registrazione Utente</h2>
<?php else: ?>
<h2>Registrazione Azienda</h2>
<h4>Per poter usare appieno il tuo account l'amministratore deve abilitare la tua azienda.
    <br />Solo dopo potrai inserire prodotti.
</h4>
<?php endif; ?>

<?php if ($this->_tpl_vars['reg_ok']): ?>
<h3>Registrazione avvenuta con successo</h3>
<h4>Riepilogo dei tuoi dati di accesso:</h4>
    username: <?php echo $this->_tpl_vars['username']; ?>
<br/>
password:<?php echo $this->_tpl_vars['password']; ?>
<br/>
email: <?php echo $this->_tpl_vars['email']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['username_exist']): ?>
<h3>Username già esistente</h3>
<?php endif; ?>
<?php if (! $this->_tpl_vars['reg_ok']): ?>
<form action="" method="post" id="reg_utente" name="reg_utente" onsubmit="return verificaRegUtente();">
    <table>
        <tr><td><input type="hidden" name="save" /></td></tr>
        <tr><td>username:<td><input type="text" name="username"/></td></tr>
        <tr><td> password:</td> <td><input type="password" name="password"/></td></tr>
        <tr><td>email:</td> <td><input type="text" name="email"/></td></tr>
        <tr><td><input type="submit" value="Registrati"/></td></tr>
    </table>
</form>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>