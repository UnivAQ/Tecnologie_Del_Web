{ if $aggiungi_parcheggio and ! $read_only }
	<form action="index.php?action=aggiungi_parcheggio" method="post" name="parkForm" onSubmit="return reg_park();">
{ elseif $modifica_parcheggio and ! $read_only }
	<form action="index.php?action=modifica_parcheggio&parcheggio_id={ $parcheggio_id }" method="post" name="parkForm" onSubmit="return reg_park();">
{ /if }
	<table style="border : 0; width : 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	{ if ! $aggiungi_parcheggio }
	<tr>
		<td colspan="2"><h2>Dati parcheggio: "{ $nome }"</h2></td>		
	</tr>
	<tr>
		<td colspan="2"><div id="map_canvas" style="width: 500px; height: 300px; text-align : center"></div></td>
	</tr>
	{ else }
	<tr>
		<td colspan="2"><h2>Aggiungi parcheggio</h2></td>		
	</tr>
	{ /if }
	<tr>
		<td colspan="2"><p id="errmsg" style="visibility:hidden;display:none;font-size:14px;color:red;"></p></td>
	</tr>
	
	<tr>
		<td>Nome</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="nome" value="{$nome}" size="25" maxlength="100" /></td>
		{ else }
		<td style="text-align : right"><p>{ $nome }</p></td>
		{ /if }
	</tr>
	<tr>
	<tr>
		<td>Via</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="via" value="{$via}" size="25" maxlength="100" /></td>
		{ else }
		<td style="text-align : right"><p>{ $via }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>Numero civico</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="civico" value="{$civico}" size="10" maxlength="10" /></td>
		{ else }
		<td style="text-align : right"><p>{ $civico }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>Comune</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="comune" value="{$comune}" size="25" maxlength="100" /></td>
		{ else }
		<td style="text-align : right"><p>{ $comune }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>Provincia</td>
		{ if ! $read_only }
		<td style="text-align : right"><select name="provincia">
											<option value=""></option>
											<option value="AG" { if $provincia == "AG" } selected = "selected"{ /if }>AGRIGENTO</option>
											<option value="AL" { if $provincia == "AL" } selected = "selected"{ /if }>ALESSANDRIA</option>
											<option value="AN" { if $provincia == "AN" } selected = "selected"{ /if }>ANCONA</option>
											<option value="AO" { if $provincia == "AO" } selected = "selected"{ /if }>AOSTA</option>
											<option value="AR" { if $provincia == "AR" } selected = "selected"{ /if }>AREZZO</option>
											<option value="AP" { if $provincia == "AP" } selected = "selected"{ /if }>ASCOLI PICENO</option>
											<option value="AT" { if $provincia == "AT" } selected = "selected"{ /if }>ASTI</option>
											<option value="AV" { if $provincia == "AV" } selected = "selected"{ /if }>AVELLINO</option>
											<option value="BA" { if $provincia == "BA" } selected = "selected"{ /if }>BARI</option>
											<option value="BL" { if $provincia == "BL" } selected = "selected"{ /if }>BELLUNO</option>
											<option value="BN" { if $provincia == "BN" } selected = "selected"{ /if }>BENEVENTO</option>
											<option value="BG" { if $provincia == "BG" } selected = "selected"{ /if }>BERGAMO</option>
											<option value="BI" { if $provincia == "BI" } selected = "selected"{ /if }>BIELLA</option>
											<option value="BO" { if $provincia == "BO" } selected = "selected"{ /if }>BOLOGNA</option>
											<option value="BZ" { if $provincia == "BZ" } selected = "selected"{ /if }>BOLZANO</option>
											<option value="BS" { if $provincia == "BS" } selected = "selected"{ /if }>BRESCIA</option>
											<option value="BR" { if $provincia == "BR" } selected = "selected"{ /if }>BRINDISI</option>
											<option value="CA" { if $provincia == "CA" } selected = "selected"{ /if }>CAGLIARI</option>
											<option value="CL" { if $provincia == "CL" } selected = "selected"{ /if }>CALTANISSETTA</option>
											<option value="CB" { if $provincia == "CB" } selected = "selected"{ /if }>CAMPOBASSO</option>
											<option value="CE" { if $provincia == "CE" } selected = "selected"{ /if }>CASERTA</option>
											<option value="CT" { if $provincia == "CT" } selected = "selected"{ /if }>CATANIA</option>
											<option value="CZ" { if $provincia == "CZ" } selected = "selected"{ /if }>CATANZARO</option>
											<option value="CH" { if $provincia == "CH" } selected = "selected"{ /if }>CHIETI</option>
											<option value="CO" { if $provincia == "CO" } selected = "selected"{ /if }>COMO</option>
											<option value="CS" { if $provincia == "CS" } selected = "selected"{ /if }>COSENZA</option>
											<option value="CR" { if $provincia == "CR" } selected = "selected"{ /if }>CREMONA</option>
											<option value="KR" { if $provincia == "KR" } selected = "selected"{ /if }>CROTONE</option>
											<option value="CN" { if $provincia == "CN" } selected = "selected"{ /if }>CUNEO</option>
											<option value="EN" { if $provincia == "EN" } selected = "selected"{ /if }>ENNA</option>
											<option value="FE" { if $provincia == "FE" } selected = "selected"{ /if }>FERRARA</option>
											<option value="FI" { if $provincia == "FI" } selected = "selected"{ /if }>FIRENZE</option>
											<option value="FG" { if $provincia == "FG" } selected = "selected"{ /if }>FOGGIA</option>
											<option value="FC" { if $provincia == "FC" } selected = "selected"{ /if }>FORLI'-CESENA</option>
											<option value="FR" { if $provincia == "FR" } selected = "selected"{ /if }>FROSINONE</option>
											<option value="GE" { if $provincia == "GE" } selected = "selected"{ /if }>GENOVA</option>
											<option value="GO" { if $provincia == "GO" } selected = "selected"{ /if }>GORIZIA</option>
											<option value="GR" { if $provincia == "GR" } selected = "selected"{ /if }>GROSSETO</option>
											<option value="IM" { if $provincia == "IM" } selected = "selected"{ /if }>IMPERIA</option>
											<option value="IS" { if $provincia == "IS" } selected = "selected"{ /if }>ISERNIA</option>
											<option value="SP" { if $provincia == "SP" } selected = "selected"{ /if }>LA SPEZIA</option>
											<option value="AQ" { if $provincia == "AQ" } selected = "selected"{ /if }>L'AQUILA</option>
											<option value="LT" { if $provincia == "LT" } selected = "selected"{ /if }>LATINA</option>
											<option value="LE" { if $provincia == "LE" } selected = "selected"{ /if }>LECCE</option>
											<option value="LC" { if $provincia == "LC" } selected = "selected"{ /if }>LECCO</option>
											<option value="LI" { if $provincia == "LI" } selected = "selected"{ /if }>LIVORNO</option>
											<option value="LO" { if $provincia == "LO" } selected = "selected"{ /if }>LODI</option>
											<option value="LU" { if $provincia == "LU" } selected = "selected"{ /if }>LUCCA</option>
											<option value="MC" { if $provincia == "MC" } selected = "selected"{ /if }>MACERATA</option>
											<option value="MN" { if $provincia == "MN" } selected = "selected"{ /if }>MANTOVA</option>
											<option value="MS" { if $provincia == "MS" } selected = "selected"{ /if }>MASSA-CARRARA</option>
											<option value="MT" { if $provincia == "MT" } selected = "selected"{ /if }>MATERA</option>
											<option value="ME" { if $provincia == "ME" } selected = "selected"{ /if }>MESSINA</option>
											<option value="MI" { if $provincia == "MI" } selected = "selected"{ /if }>MILANO</option>
											<option value="MO" { if $provincia == "MO" } selected = "selected"{ /if }>MODENA</option>
											<option value="NA" { if $provincia == "NA" } selected = "selected"{ /if }>NAPOLI</option>
											<option value="NO" { if $provincia == "NO" } selected = "selected"{ /if }>NOVARA</option>
											<option value="NU" { if $provincia == "NU" } selected = "selected"{ /if }>NUORO</option>
											<option value="OR" { if $provincia == "OR" } selected = "selected"{ /if }>ORISTANO</option>
											<option value="PD" { if $provincia == "PD" } selected = "selected"{ /if }>PADOVA</option>
											<option value="PA" { if $provincia == "PA" } selected = "selected"{ /if }>PALERMO</option>
											<option value="PR" { if $provincia == "PR" } selected = "selected"{ /if }>PARMA</option>
											<option value="PV" { if $provincia == "PV" } selected = "selected"{ /if }>PAVIA</option>
											<option value="PG" { if $provincia == "PG" } selected = "selected"{ /if }>PERUGIA</option>
											<option value="PU" { if $provincia == "PU" } selected = "selected"{ /if }>PESARO E URBINO</option>
											<option value="PE" { if $provincia == "PE" } selected = "selected"{ /if }>PESCARA</option>
											<option value="PC" { if $provincia == "PC" } selected = "selected"{ /if }>PIACENZA</option>
											<option value="PI" { if $provincia == "PI" } selected = "selected"{ /if }>PISA</option>
											<option value="PT" { if $provincia == "PT" } selected = "selected"{ /if }>PISTOIA</option>
											<option value="PN" { if $provincia == "PN" } selected = "selected"{ /if }>PORDENONE</option>
											<option value="PZ" { if $provincia == "PZ" } selected = "selected"{ /if }>POTENZA</option>
											<option value="PO" { if $provincia == "PO" } selected = "selected"{ /if }>PRATO</option>
											<option value="RG" { if $provincia == "RG" } selected = "selected"{ /if }>RAGUSA</option>
											<option value="RA" { if $provincia == "RA" } selected = "selected"{ /if }>RAVENNA</option>
											<option value="RC" { if $provincia == "RC" } selected = "selected"{ /if }>REGGIO DI CALABRIA</option>
											<option value="RE" { if $provincia == "RE" } selected = "selected"{ /if }>REGGIO NELL'EMILIA</option>
											<option value="RI" { if $provincia == "RI" } selected = "selected"{ /if }>RIETI</option>
											<option value="RN" { if $provincia == "RN" } selected = "selected"{ /if }>RIMINI</option>
											<option value="RM" { if $provincia == "RM" } selected = "selected"{ /if }>ROMA</option>
											<option value="RO" { if $provincia == "RO" } selected = "selected"{ /if }>ROVIGO</option>
											<option value="SA" { if $provincia == "SA" } selected = "selected"{ /if }>SALERNO</option>
											<option value="SS" { if $provincia == "SS" } selected = "selected"{ /if }>SASSARI</option>
											<option value="SV" { if $provincia == "SV" } selected = "selected"{ /if }>SAVONA</option>
											<option value="SI" { if $provincia == "SI" } selected = "selected"{ /if }>SIENA</option>
											<option value="SR" { if $provincia == "SR" } selected = "selected"{ /if }>SIRACUSA</option>
											<option value="SO" { if $provincia == "SO" } selected = "selected"{ /if }>SONDRIO</option>
											<option value="TA" { if $provincia == "TA" } selected = "selected"{ /if }>TARANTO</option>
											<option value="TE" { if $provincia == "TE" } selected = "selected"{ /if }>TERAMO</option>
											<option value="TR" { if $provincia == "TR" } selected = "selected"{ /if }>TERNI</option>
											<option value="TO" { if $provincia == "TO" } selected = "selected"{ /if }>TORINO</option>
											<option value="TP" { if $provincia == "TP" } selected = "selected"{ /if }>TRAPANI</option>
											<option value="TN" { if $provincia == "TN" } selected = "selected"{ /if }>TRENTO</option>
											<option value="TV" { if $provincia == "TV" } selected = "selected"{ /if }>TREVISO</option>
											<option value="TS" { if $provincia == "TS" } selected = "selected"{ /if }>TRIESTE</option>
											<option value="UD" { if $provincia == "UD" } selected = "selected"{ /if }>UDINE</option>
											<option value="VA" { if $provincia == "VA" } selected = "selected"{ /if }>VARESE</option>
											<option value="VE" { if $provincia == "VE" } selected = "selected"{ /if }>VENEZIA</option>
											<option value="VB" { if $provincia == "VB" } selected = "selected"{ /if }>VERBANO-CUSIO-OSSOLA</option>
											<option value="VC" { if $provincia == "VC" } selected = "selected"{ /if }>VERCELLI</option>
											<option value="VR" { if $provincia == "VR" } selected = "selected"{ /if }>VERONA</option>
											<option value="VV" { if $provincia == "VV" } selected = "selected"{ /if }>VIBO VALENTIA</option>
											<option value="VI" { if $provincia == "VI" } selected = "selected"{ /if }>VICENZA</option>
											<option value="VT" { if $provincia == "VT" } selected = "selected"{ /if }>VITERBO</option>
									</select></td>
		{ else }
		<td style="text-align : right"><p>{ $provincia }</p></td>
		{ /if }
	</tr>
	<tr>
		<td>CAP</td>
		{ if ! $read_only }
		<td style="text-align : right"><input type="text" name="cap" value="{$cap}" size="5" maxlength="5" /></td>
		{ else }
		<td style="text-align : right"><p>{ $cap }</p></td>
		{ /if }
	</tr>
	{ if $mostra_parcheggio }
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="border: 1px solid #E7E7E7; text-align : center; width : 50%"><a href="index.php?action=aggiungi_preferiti&parcheggio_id={ $parcheggio_id }">Aggiungi ai preferiti</a></td>
		<td style="border: 1px solid #E7E7E7; text-align : center; width : 50%"><a href="index.php?action=prenota_sosta&parcheggio_id={ $parcheggio_id }">Prenota una sosta</a></td>
	</tr>
	{ /if }
	{ if ! $read_only }
	<tr>
		<td>&nbsp;</td>
		<td style="text-align : right"><input type="submit" value="Invia" size="5" { if $modifica_parcheggio } onclick="return conferma();" { /if } /></td>
	</tr>
	{ /if }
	</table>
	{ if ! $read_only }
	<input type="hidden" name="step" value="2" />
</form>
{ /if }
