<h2>Lista Posto Auto</h2>
<br />
<table style="border : 0; width : 100%">
{ foreach from=$postoauto_array key=id item=postoauto }
	<tr>
	<td style="text-align : left"><p>{ $postoauto }</p></td>
	<td style="text-align : right"><p><a href="index.php?action=modifica_postoauto&parcheggio_id={ $parcheggio_id }&postoauto_id={ $id }">view</a> - <a href="index.php?action=cancella_posto&parcheggio_id={ $parcheggio_id }&postoauto_id={ $id }" onclick="return conferma();">del</a></p></td></tr>
{ /foreach }
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	{ if ! $read_only }
	<tr>
	<td style="text-align : left"><a href="index.php?action=aggiungi_postoauto&parcheggio_id={ $parcheggio_id }">Aggiungi Posti Auto</a></td>
	</tr>
	{ /if }
</table>
<br />