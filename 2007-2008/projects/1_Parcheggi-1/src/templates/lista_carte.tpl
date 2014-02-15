<h2>Lista carte</h2>
<br />
<table style="border : 0; width : 100%">
{ foreach from=$carte_array key=id item=carta }
	<tr><td style="text-align : left"><p>{ $carta }</p></td><td style="text-align : right"><p><a href="index.php?action=modifica_carta&carta_id={ $id }">view</a> - <a href="index.php?action=cancella_carta&carta_id={ $id }" onclick="return conferma();">del</a></p></td></tr>
{ /foreach }
</table>
<br />