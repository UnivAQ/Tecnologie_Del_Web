
<h2>Lista messaggi ricevuti</h2>
<br />
<table style="border : 0; width : 100%">
{ if $messaggi_in }
{ foreach from=$messaggiin_array key=id item=titolo }
	<tr><td style="text-align : left"><p>{ $titolo }</p></td><td style="text-align : right"><p><a href="index.php?action=leggi_messaggio&messaggio_id={ $id }">leggi</a> - <a href="index.php?action=cancella_messaggio&messaggio_id={ $id }" onclick="return conferma();">del</a></p></td></tr>
{ /foreach }
{ else }
	<tr><td style="text-align : left" colspan="2"><p>Nessun messaggio ricevuto.</p></td></tr>
{ /if }
</table>

<br />

<h2>Lista messaggi inviati</h2>
<br />
<table style="border : 0; width : 100%">
{ if $messaggi_out }
{ foreach from=$messaggiout_array key=id item=titolo }
	<tr><td style="text-align : left"><p>{ $titolo }</p></td><td style="text-align : right"><p><a href="index.php?action=leggi_messaggio&messaggio_id={ $id }">leggi</a> - <a href="index.php?action=cancella_messaggio&messaggio_id={ $id }" onclick="return conferma();">del</a></p></td></tr>
{ /foreach }
{ else }
	<tr><td style="text-align : left" colspan="2"><p>Nessun messaggio inviato.</p></td></tr>
{ /if }
</table>

<br />