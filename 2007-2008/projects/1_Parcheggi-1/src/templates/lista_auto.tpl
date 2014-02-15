<h2>Lista automezzi</h2>
<br />
<table style="border : 0; width : 100%">
{ foreach from=$auto_array key=id item=cose }
	<tr><td style="text-align : left"><p>{ $cose.marca } { $cose.nome } "{ $cose.targa }"</p></td><td style="text-align : right"><p><a href="index.php?action=modifica_auto&auto_id={ $id }">view</a> - <a href="index.php?action=cancella_auto&auto_id={ $id }" onClick="return conferma();">del</a></p></td></tr>
{ /foreach }
</table>
<br />