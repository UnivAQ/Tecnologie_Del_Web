<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>{ $title }</title>

<!-- Meta Tags -->
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />

<!-- CSS -->
<link rel="stylesheet" href="{ $css }" media="all" type="text/css" />
<script type="text/javascript" src="js/checkfields.js"></script>
{ if $home_page or $mostra_parcheggio or $modifica_parcheggio }
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAlezIzD4R9C1VCn7f741fBRTBtds9mgN8E4nkmNH1W9fo8Oyx0RRa4h2qvByhI_WMWb5XWo1Qv5zjpA&amp;hl=it" type="text/javascript"></script>
<script type="text/javascript">
	{ literal }
	function initialize() {
	{ /literal }
		
	    var map = new GMap2(document.getElementById("map_canvas"));
	    map.setCenter(new GLatLng({ $lat }, { $lon }), 16);
	    map.addControl(new GLargeMapControl());
	    map.addControl(new GMapTypeControl());
	    map.addOverlay(new GMarker(new GLatLng({ $lat }, { $lon })));
	{ literal }
	}
	{ /literal }
</script>
{ /if }
<script type="text/javascript">
{ literal }
	
	function conferma() 
	{
	{ /literal }
		if (confirm('{ $messaggio_sicurezza }'))
		{ literal }
		{
			return true;
		}
		return false;
		{ /literal }
	{ literal }
	}
	{ /literal }
</script>
</head>