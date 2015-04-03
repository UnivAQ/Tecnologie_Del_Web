{ if $lista_gruppi }
	<h2>Lista gruppi</h2>
	<br />
	<table style="border : 0; width : 100%">
	{ foreach from=$gruppi_array key=id item=cosa }
		{ if not $my } 
		<tr><td style="text-align : left"><p>{ $cosa.nome }</p></td><td style="text-align : right"><p><a href="index.php?action=modifica_gruppo&gruppo_id={ $id }">mod</a> - <a href="index.php?action=lista_utentigruppo&gruppo_id={ $id }">lista utenti</a> - <a href="index.php?action=aggiungi_utentegruppo&gruppo_id={ $id }">add utente</a> - <a href="index.php?action=cancella_gruppo&gruppo_id={ $id }" onclick="return conferma();">del</a></p></td></tr>
		{ else }
		<tr><td style="text-align : left"><p>{ $cosa.nome }</p></td><td style="text-align : right"><p><a href="index.php?action=cancella_utentegruppo&gruppo_id={ $id }&id={ $cosa.id }" onclick="return conferma();">leave</a></p></td></tr>
		{ /if }
	{ /foreach }
	</table>
	<br />
{ elseif $lista_utentigruppo }
	<h2>Lista utenti del gruppo "{ $gruppo }"</h2>
	<br />
	<table style="border : 0; width : 100%">
	{ foreach from=$utenti_array key=id item=cosa }
		<tr><td style="text-align : left"><p>{ $cosa.nome }</p></td><td style="text-align : right"><p><a href="index.php?action=cancella_utentegruppo&gruppo_id={ $cosa.gid }&id={ $id }" onclick="return conferma();">remove</a></p></td></tr>
	{ /foreach }
	</table>
	<br />
{ /if }