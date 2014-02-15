<ul>

<li><a href="index.php?action=contact">Contatti</a></li>
<li><a href="index.php?action=help">Aiuto</a></li>
{ if $amministratore }<li><a href="index.php?action=admin">Amministrazione</a></li>{ /if }
{ if $parcheggio }<li><a href="index.php?action=parcheggio">Parcheggi</a><li>{ /if }
{ if $authn }<li><a href="index.php?action=messaggi">Messaggi</a></li>{ /if }
{ if $authn }<li><a href="index.php?action=profilo">Profilo</a></li>{ /if }
<li style="float : left"><a href="index.php">{ $header }</a></li>

</ul>