var sezione;

function showSubsections(id,name) {
	var form = document.forms["form_contenuto"];
	var selectedSection = "sezioni_" + id;
	sezione = name;
	var innerSezione = document.getElementById(sezione);
	
	if (innerSezione.innerHTML != '') {
		innerSezione.innerHTML = "";
		return;
	}
	
	http_request = false;
	if (window.XMLHttpRequest) {
		http_request= new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/xml');
		}
	} else if (window.ActiveXObject) {
		try {http_request= new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			http_request= new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
		}
	} if (!http_request) {
		alert("E' stato riscontrato un problema nella connessione al server.");
		return false;
	}
	var stringToSend = 'idsection=' + id;
	http_request.onreadystatechange = showSubResults;
	http_request.open('GET', 'zuppiu_subsection_search.php?' + stringToSend, true);
	http_request.send(null);
}

function showSubResults() {
	var subsections = document.getElementById(sezione);
	
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			while (http_request.responseText == "") {}
			subsections.innerHTML = http_request.responseText;
		} else {
			subsections.innerHTML = "Nessuna sottosezione";
		}
	} else {
			subsections.innerHTML = "Loading...";
	}
	
}