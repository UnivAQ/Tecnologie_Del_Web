<h2>Lista prenotazioni effettuate</h2>
<br />
<table style="border : 0; width : 100%">
{ foreach from=$soste_array key=id item=cose }
	<tr><td style="text-align : left"><p>{ $cose.marca } { $cose.nome } "{ $cose.targa }" da { $cose.arrivo } a { $cose.partenza}</p></td><td style="text-align : right"><p><a href="index.php?action=cancella_sosta&sosta_id={ $cose.id }" onclick="return conferma();">del</a></p></td></tr>
{ /foreach }
</table>
<br />