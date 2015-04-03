function initialize() {
	if (GBrowserIsCompatible()) {
		var request = GXmlHttp.create();
		request.open("GET", "/services/", true);
		request.onreadystatechange = function() {
	  	if (request.readyState == 4) {
		    alert(request.responseText);
	  	}
		}
		request.send(null);
		
	    var map = new GMap2(document.getElementById("map_canvas"));
	    map.setCenter(new GLatLng(42.4626, 14.2175), 15);
	    map.addControl(new GLargeMapControl());
	    map.addControl(new GMapTypeControl());
	    map.addOverlay(new GMarker(new GLatLng(42.4626, 14.2175)));
	}
}