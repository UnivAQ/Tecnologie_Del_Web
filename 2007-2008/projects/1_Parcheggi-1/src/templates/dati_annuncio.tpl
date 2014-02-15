<h2 style="text-align : center">Dati annuncio</h2>
<p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p>
{ if $aggiungi_annuncio }
	<form action="index.php?action=aggiungi_annuncio" method="post" name="annuncioForm" onSubmit="return reg_annuncio();">
{ elseif $approva_annuncio }
	<form action="index.php?action=approva_annuncio&annuncio_id={ $annuncio_id }" method="post">
{ /if }
	<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	{ if $aggiungi_annuncio }
		<td>Titolo</td>
		<td style="text-align : right"><input type="text" name="titolo" size="25" maxlength="100" /></td>
	{ elseif $approva_annuncio }
		<td style="text-align : center" colspan="2"><h3>{ $titolo }</h3></td>
	{ /if }
	</tr>
	<tr>
	{ if $aggiungi_annuncio }
		<td>Annuncio</td>
		<td style="text-align : right"><textarea name="corpo" cols="30" rows="10"></textarea></td>
	{ elseif $approva_annuncio }
		<td style="text-align : left" colspan="2"><p>{ $corpo }</p></td>
	{ /if }
	</tr>
{ if $approva_annuncio and ! $my }
	<tr>
		<td>Approvazione</td>
		<td style="text-align : right"><select name="moderazione"><option value="1">S&igrave;</option><option value="0">No</option></select></td>
	</tr>
{ /if }
{ if ! $my }
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" /></td>
	</tr>
{ /if }
	</table>
	<input type="hidden" name="step" value="2" />
</form>