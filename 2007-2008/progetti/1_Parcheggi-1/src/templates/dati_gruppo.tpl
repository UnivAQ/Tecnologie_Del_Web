{ if $aggiungi_gruppo }
	<form action="index.php?action=aggiungi_gruppo" method="post">
{ elseif $modifica_gruppo }
	<form action="index.php?action=modifica_gruppo&gruppo_id={ $gruppo_id }" method="post">
{ /if }
	<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Nome</td>
		<td style="text-align : right"><input type="text" name="nome" value="{ $nome }" size="25" maxlength="50" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Permessi</b></td>
		<td>&nbsp;</td>
	</tr>
	{ foreach from=$table_array key=id item=cosa }
	<tr>
		<td>{ $cosa.nome }</td>
		<td style="text-align : right">
			<select name="{ $cosa.nome }">
				<option value="0" { if $cosa.permesso == 0 }selected="selected"{ /if }>Niente</input>
				<option value="1" { if $cosa.permesso == 1 }selected="selected"{ /if }>Creazione</input>
				<option value="2" { if $cosa.permesso == 2 }selected="selected"{ /if }>Visualizzazione</input>
				<option value="3" { if $cosa.permesso == 3 }selected="selected"{ /if }>Cancellazione</input>
				<option value="4" { if $cosa.permesso == 4 }selected="selected"{ /if }>Modifica</input>
			</select>
		</td>
	</tr>
	{ /foreach }
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	{ if ! $read_only }
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" { if $modifica_gruppo } onclick="return conferma();" { /if }/></td>
	</tr>
	{ /if }
	</table>
	<input type="hidden" name="step" value="2" />
</form>	