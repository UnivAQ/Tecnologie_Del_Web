<form action="index.php?action=aggiungi_utentegruppo&gruppo_id={ $gruppo_id }" method="post">
<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Gruppo: "{ $gruppo }"</b></td>
		<td>
			<select name="id_utente">
			{ foreach from=$utenti_array key=id item=nome }
				<option value="{ $id }">{ $nome }</option>
			{ /foreach }
			</select>
		</td>
		
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" onclick="return conferma();"/></td>
	</tr>
	</table>
	<input type="hidden" name="step" value="2" />
</form>