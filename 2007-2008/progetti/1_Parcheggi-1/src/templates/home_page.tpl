<h2 style="text-align : center">Parcheggi Italia</h2>
<h3 style="text-align : center"><a href="index.php?action=cerca_parcheggio">Stai cercando un parcheggio? Se si, cosa aspetti ad utilizzare il nostro servizio?</a></h3>
<br />
<div id="map_canvas" style="width: 500px; height: 300px; text-align : center"></div>

<br />
<br />

<h3 style="text-align : center"><a href="index.php?action=cerca_parcheggio">Cerca un parcheggio nei pressi di un luogo a tua scelta!</a></h3>

<br />
<br />
<br />

<h2 style="text-align : center">Annunci</h2>

{ if $annunci }
{ foreach from=$annunci_array key=id item=cosa }
	<h3 style="text-align : center">{ $cosa.titolo }</h3>
	<p style="text-align : center">{ $cosa.data }</p>
	<p>{ $cosa.corpo }</p>
	<br />
{ /foreach }
{ else }
	<h3 style="text-align : center">Non ci sono annunci</h3>
{ /if }
