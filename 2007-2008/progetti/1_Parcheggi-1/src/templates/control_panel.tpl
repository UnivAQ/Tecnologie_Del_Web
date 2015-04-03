{ if $logged }
	<p style="text-align : center">Benvenuto <b>{ $username }</b></p>
	<br />
	<ul style="text-align : left">
	<li><a href="index.php?action=cerca_parcheggio">Cerca parcheggio</a></li>
	<li><a href="index.php?action=lista_parcheggi&preferiti">Lista preferiti</a></li>
	<li><a href="{ $back }">Torna indietro</a></li>
	<li><a href="index.php?action=logout">Logout</a></li>
	</ul> 
	<br />
{ if $nuovi_messaggi and $numero_messaggi > 1 }
	<p style="text-align : left">Ci sono { $numero_messaggi } nuovi messaggi!</p>
{ elseif $nuovi_messaggi and $numero_messaggi == 1 }
	<p style="text-align : left">C'&egrave; { $numero_messaggi } nuovo messaggio!</p>
{ /if }
	<br />
{ else }
   	{ include file="login.tpl" }
{ /if }	
