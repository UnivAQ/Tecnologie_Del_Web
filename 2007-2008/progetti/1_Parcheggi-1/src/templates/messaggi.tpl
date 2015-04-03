
<h2>Messaggi</h2>

{ if $nuovi_messaggi }
	<p>Questi sono i tuoi nuovi messaggi { $username }.</p>
	{ foreach from=$messaggi_array key=id item=titolo }
		<ol>
			<li><a href="index.php?action=leggi_messaggio&messaggio_id={ $id }">{ $titolo }</a></li>
		</ol>
	{ /foreach }
{ else }
	<p>Non ci sono nuovi messaggi per te { $username }.</p>
{ /if }

<br />

<ul>
	<li><a href="index.php?action=lista_messaggi">Vai alla lista di tutti i messaggi</a></li>
	<li><a href="index.php?action=invia_messaggio">Scrivi un messaggio ad un altro utente</a></li>
</ul>