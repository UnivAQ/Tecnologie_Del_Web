{ if $preferiti }
	<h2>Lista parcheggi preferiti</h2>
{ elseif $my }
	<h2> Lista propri parcheggi</h2>
{ else }
	<h2>Lista parcheggi</h2>
{ /if }
<br />
<table style="border : 0; width : 100%">
{ foreach from=$parcheggi_array key=id item=parcheggio }
	<tr>
		<td style="text-align : left"><p>{ $parcheggio }</p></td>
        <td style="text-align : right">
        { if $preferiti }
            <p><a href="index.php?action=mostra_parcheggio&parcheggio_id={ $id }">view</a> - <a href="index.php?action=cancella_preferiti&parcheggio_id={ $id }" onClick="return conferma();">del</a></p>
        { else }
        	<p><a href="index.php?action=modifica_parcheggio&parcheggio_id={ $id }">view</a> - <a href="index.php?action=cancella_parcheggio&parcheggio_id={ $id }" onClick="return conferma();">del</a> - <a href="index.php?action=lista_postoauto&parcheggio_id={ $id }">posti</a></p>
        { /if }
        </td>
	</tr>
{ /foreach }
</table>
<br />