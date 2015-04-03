<p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p>
{ if $aggiungi_carta }
	<form action="index.php?action=aggiungi_carta" method="post" name="cartaForm" onSubmit="return add_carta();">
{ elseif $modifica_carta }
	<form action="index.php?action=modifica_carta&carta_id={ $carta_id }" method="post" name="cartaForm" onSubmit="return add_carta();">
{ /if }
<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><b>Dettagli Carta</b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Intestatario</td>
		<td style="text-align : right"><input type="text" name="intestatario" value="{$intestatario}" size="40" maxlength="100" /></td>
	</tr>
	<tr>
		<td>Tipo</td>
		<td style="text-align : right"><select name="tipo" ><option value="Visa">Visa</option><option value="Mastercard">Mastercard</option></select></td>
	</tr>
    <tr>
		<td>Numero</td>
		<td style="text-align : right"><input type="text" name="numero" value="{$numero}" size="25" maxlength="25" /></td>
	</tr>
	<tr>
		<td>Codice di sicurezza (max 3 car.)</td>
		<td style="text-align : right"><input type="text" name="c_sic" value="{$c_sic}" size="3" maxlength="3" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" { if $modifica_carta } onclick="return conferma();" { /if } /></td>
	</tr>
	</table>
	<input type="hidden" name="step" value="2" />
</form>