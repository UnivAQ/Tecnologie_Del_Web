{ if $invia_messaggio }
	<form action="index.php?action=invia_messaggio" method="post">
{ elseif $leggi_messaggio }
	<form action="index.php?action=invia_messaggio&messaggio_id={ $messaggio_id }" method="post">
{ /if }
	<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	{ if $invia_messaggio }
		<td>Titolo</td>
		<td style="text-align : right"><input type="text" name="titolo" value="{ $titolo }" size="32" maxlength="100" /></td>
	{ elseif $leggi_messaggio }
		<td style="text-align : right"><h3 style="text-align : center">{ $mittente }: { $titolo }</h3></td>
	{ /if }
	</tr>
	<tr>
	{ if $invia_messaggio }
		<td>Annuncio</td>
		<td style="text-align : right"><textarea name="corpo" cols="30" rows="10">{ $corpo }</textarea></td>
	{ elseif $leggi_messaggio }
		<br />
		<td style="text-align : left"><p>{ $corpo }</p></td>
	{ /if }
	</tr>
	{ if $invia_messaggio }
	<tr>
		<td>Destinatario</td>
		<td style="text-align : right"><input type="text" name="destinatario" value="{ $destinatario }" size="32" maxlength="25" /></td>
	{ /if }
	<tr>
		<td>&nbsp;</td>
	{ if $invia_messaggio }
		<td style="text-align : right"><input type="submit" value="Invia" size="5" /></td>
	{ elseif $leggi_messaggio and not $read_only }
		<td style="text-align : right"><input type="submit" value="Rispondi" size="5" /></td>
	{ /if }
	</tr>
	</table>
	{ if $invia_messaggio }
	<input type="hidden" name="step" value="2" />
	{ /if }
</form>