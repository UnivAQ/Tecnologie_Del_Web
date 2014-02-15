var http_html_request;

function showHTMLFile(arg) {
	var dest = document.getElementById("htmlfile");
	
	if(dest.innerHTML != "") {
		dest.innerHTML = "";
		return;
	}
	
	http_html_request = false;
	if (window.XMLHttpRequest) {
		http_html_request= new XMLHttpRequest();
		if (http_html_request.overrideMimeType) {
			http_html_request.overrideMimeType('text/xml');
		}
	} else if (window.ActiveXObject) {
		try {http_html_request= new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			http_html_request= new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
		}
	} if (!http_html_request) {
		alert("E' stato riscontrato un problema nella connessione al server.");
		return false;
	}
	var htmlfile = 'nome=' + arg;
	http_html_request.onreadystatechange = showHTMLContent;
	http_html_request.open('GET', 'zuppiu_file_show_html.php?' + htmlfile, true);
	//http_html_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http_html_request.send(null);
}

function showHTMLContent() {
	var doing = document.getElementById("htmlfile");
	
	if (http_html_request.readyState == 4) {
		if (http_html_request.status == 200) {
			while (http_html_request.responseText == "") {}
			doing.innerHTML = http_html_request.responseText;
		} else {
			doing.innerHTML = "Loading...";
		}
	}	
	
}