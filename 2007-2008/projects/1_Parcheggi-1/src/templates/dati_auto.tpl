<h2 style="text-align : center">Dati automezzo</h2>
<p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p>
{ if $aggiungi_auto }
	<form action="index.php?action=aggiungi_auto" method="post" name="autoForm" onSubmit="return reg_auto();">
{ elseif $modifica_auto }
	<form action="index.php?action=modifica_auto&auto_id={ $auto_id }" method="post" name="autoForm" onSubmit="return reg_auto();">
{ /if }
	<table style="border : 0; width : 100%">
	{ if $modifica_auto }
	<tr>
		<td colspan="2"><b>N.B. &egrave; possibile modificare solo la targa.</b></td>
	</tr>
	{ /if }
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><p>Marca</p></td>
		<td style="text-align : right"><input type="text" name="marca" value="{ $marca }" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td><p>Modello</p></td>
		<td style="text-align : right"><input type="text" name="modello" value="{ $modello }" size="25" maxlength="100" /></td>
	</tr>
	<tr>
		<td><p>Targa</p></td>
		<td style="text-align : right"><input type="text" name="targa" value="{ $targa }" size="25" maxlength="10" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Caratteristiche</b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><p>Larghezza</p></td>
		<td style="text-align : right"><input type="text" name="larghezza" value="{ $larghezza }" size="25" maxlength="10" /></td>
	</tr>
	<tr>
		<td><p>Lunghezza</p></td>
		<td style="text-align : right"><input type="text" name="lunghezza" value="{ $lunghezza }" size="25" maxlength="10" /></td>
	</tr>
	<tr>
		<td><p>Altezza</p></td>
		<td style="text-align : right"><input type="text" name="altezza" value="{ $altezza }" size="25" maxlength="10" /></td>
	</tr>
	{ if ! $read_only }
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" { if $modifica_auto } onclick="return conferma();" {/if} /></td>
	</tr>
	{ /if }
	</table>
	<input type="hidden" name="step" value="2" />
</form>	