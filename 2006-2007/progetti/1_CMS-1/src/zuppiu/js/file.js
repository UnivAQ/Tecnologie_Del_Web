function joinFile() {
	var inputfile = document.getElementById("file");
	
	if (inputfile.innerHTML != '') {
		inputfile.innerHTML = '';
		return;
	}
	
	inputfile.innerHTML = "<td valign=\"top\" align=\"left\" width=\"75%\" colspan=\"2\">Associa File<br/>\n" +
						  "<input type=\"text\" name=\"pattern\" size=\"20\" />&nbsp;\n" +
						  "<select name=\"filetype\">\n" +
						  "<option value=\"\">Seleziona...</option>\n" +
						  "<option value=\"tutti\">Tutti i tipi</option>\n" +
						  "<option value=\"image/jpeg\">Immagine JPEG</option>\n" +
						  "<option value=\"image/bmp\">Immagine BMP</option>\n" +
						  "<option value=\"image/png\">Immagine PNG</option>\n" +
						  "<option value=\"application/pdf\">Documento PDF</option>\n" +
						  "<option value=\"application/msword\">Documento MS Word</option>\n" +
						  "<option value=\"application/msexcel\">Documento MS Excel</option>\n" +
						  "<option value=\"text/plain\">File di testo</option>\n" +
						  "<option value=\"text/html\">File HTML</option>\n" +
						  "</select>\n" +
						  "&nbsp;<button class=\"other\" type=\"button\" onClick=\"searchFile();\">Cerca</button>\n" +
						  "<div id=\"results\"></div>\n" +
						  "</td>\n" +
						  "<td valign=\"top\" align=\"right\" width=\"25%\"><p align=\"center\">" +
						  "<select class=\"populate\" name=\"attach\" size=\"10\"></select><br/><button class=\"other\" type=\"button\" onclick=\"removeFile();\">Rimuovi</button></p>" + 
						  "</td>";
}

function searchFile() {
	var form = document.forms["form_contenuto"];
	
	if (form.pattern.value == "") {
		alert("Nessun file da cercare.");
		return;
	}
	if (form.filetype.options[form.filetype.selectedIndex].value == "") {
		alert("Nessuna categoria selezionata.");
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
	var stringToSend = 'filename=' + form.pattern.value + '&filetype=' + form.filetype.options[form.filetype.selectedIndex].value;
	http_request.onreadystatechange = showResults;
	http_request.open('GET', 'zuppiu_file_search.php?' + stringToSend, true);
	http_request.send(null);
}

function showResults() {
	var results = document.getElementById("results");
	
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			while (http_request.responseText == "") {}
			results.innerHTML = http_request.responseText;
		} else {
			results.innerHTML = "File not found.";
		}
	} else {
			results.innerHTML = "Sto cercando i files...";
	}
	
}

function addFile(arg) {
	var form = document.forms["form_contenuto"];
	var nextFile = form.attach.options.length;
	
	for (var i = 0; i < nextFile; i++) {
		if (arg == form.attach.options[i].value) {
			alert("File già associato.");
			return;
		}
	}
	
	form.attach.options[nextFile] = new Option(arg);
	form.attach.options[nextFile].value = arg;
}

function removeFile() {
	var form = document.forms["form_contenuto"];
	
	form.attach.remove(form.attach.selectedIndex);
}