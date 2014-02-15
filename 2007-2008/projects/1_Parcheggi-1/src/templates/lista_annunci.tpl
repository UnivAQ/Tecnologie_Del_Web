<h2>Lista annunci</h2>
<br />
<table style="border : 0; width : 100%">
{ foreach from=$annunci_array key=id item=titolo }
	<tr><td style="text-align : left"><p>{ $titolo }</p></td><td style="text-align : right"><p><a href="index.php?action=approva_annuncio&annuncio_id={ $id }{ if not $menu_amministrazione }&my{else}{ /if }">view</a> - <a href="index.php?action=cancella_annuncio&annuncio_id={ $id }" onClick="return conferma();">del</a></p></td></tr>
{ /foreach }
</table>
<br />