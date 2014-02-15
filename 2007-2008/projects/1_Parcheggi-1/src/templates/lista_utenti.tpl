<h2>Lista utenti registrati</h2>
<br />
<p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p>
<table style="border : 0; width : 100%">
{ foreach from=$user_array key=id item=username }
	<tr><td style="text-align : left"><p>{ $username }</p></td><td style="text-align : right"><p><a href="index.php?action=modifica_utente&id={ $id }">view</a> - <a href="index.php?action=cancella_utente&id={ $id }" onClick="return conferma();">del</a></p></td></tr>
{ /foreach }
</table>
<br />
