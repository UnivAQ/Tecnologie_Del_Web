<h2 style="text-align : center">Dati posto auto</h2>
<p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p>
{ if $aggiungi_postoauto and ! $read_only}
	<form action="index.php?action=aggiungi_postoauto&parcheggio_id={ $parcheggio_id }" method="post" name="postoForm" onSubmit="return reg_posto();">
{ elseif $modifica_postoauto and ! $read_only}
	<form action="index.php?action=modifica_postoauto&parcheggio_id={ $parcheggio_id }&postoauto_id={ $id }" method="post" name="postoForm" onSubmit="return reg_posto();">
{ /if }
<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		{ if ! $read_only }
		<td><b>Dettagli Posti</b></td>
		<td>&nbsp;</td>
	</tr>
		{ /if }
	<tr>
		<td>Totale</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="totale" value="{$totale}" size="5" maxlength="5" /></td>
		{ else }
		<td style="text-align : right"><p>{ $totale }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>Larghezza</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="larghezza" value="{$larghezza}" size="5" maxlength="5" /></td>
		{ else }
		<td style="text-align : right"><p>{ $larghezza }</p></td>
		{ /if }
	</tr>
    <tr>
		<td>Lunghezza</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="lunghezza" value="{$lunghezza}" size="5" maxlength="5" /></td>
		{ else }
		<td style="text-align : right"><p>{ $lunghezza }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>Altezza</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="altezza" value="{$altezza}" size="5" maxlength="5" /></td>
		{ else }
		<td style="text-align : right"><p>{ $altezza }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>Tariffa Oraria</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="tariffa_oraria" value="{$tariffa_oraria}" size="5" maxlength="5" /></td>
		{ else }
		<td style="text-align : right"><p>{ $tariffa_oraria }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	{ if ! $read_only }
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" onClick="return conferma();"/></td>
	</tr>
	{ /if }
	</table>
	{ if ! $read_only }
	<input type="hidden" name="step" value="2" />
</form>
{ /if }