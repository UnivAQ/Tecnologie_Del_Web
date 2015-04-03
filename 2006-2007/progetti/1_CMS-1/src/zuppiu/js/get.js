var http_request;
var http_group_request;

function uploadFile() {
	var form = document.forms["form_file"];
	
	if (form.userfile.value == "") {
		alert("Nessun file da caricare.");
		return;
	}
	
	var array = new Array();
	// ESTRAZIONE NOME FILE
	array = form.userfile.value.split("\\");
	var nameOfFile = array[array.length-1];
	
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
	var stringToSend = 'filename=' + nameOfFile;
	http_request.onreadystatechange = showMessage;
	http_request.open('GET', 'zuppiu_file_check.php?' + stringToSend, true);
	//http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http_request.send(null);
}

function showMessage() {
	var doing = document.getElementById("doing");
	var form = document.forms["form_file"];
	
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			//alert(http_request.responseText);
			while (http_request.responseText == "") {}
			if (http_request.responseText == "ko" ) {
				doing.style.visibility = "visible";
				doing.innerHTML = "&nbsp;&nbsp;Il file che tenti di caricare esiste già. Rinominalo e riprova.";
				return;
			} else {
				form.submit();
			}
		} else {
			doing.style.visibility = "visible";
			doing.innerHTML = "Sto controllando il file...";
		}
	}	
	
}

/*********** GRUPPI ***********/

function addGroup() {
	var form = document.forms["form_gruppo"];
	
	if (form.nome.value == "") {
		alert("Nome gruppo mancante.");
		return;
	}
	
	http_group_request = false;
	if (window.XMLHttpRequest) {
		http_group_request= new XMLHttpRequest();
		if (http_group_request.overrideMimeType) {
			http_group_request.overrideMimeType('text/xml');
		}
	} else if (window.ActiveXObject) {
		try {http_group_request= new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			http_group_request= new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
		}
	} if (!http_group_request) {
		alert("E' stato riscontrato un problema nella connessione al server.");
		return false;
	}
	var strings = 'nome=' + form.nome.value;
	http_group_request.onreadystatechange = showGroups;
	http_group_request.open('GET', 'zuppiu_group_add.php?' + strings, true);
	//http_group_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http_group_request.send(null);
}

function showGroups() {
	var doing = document.getElementById("groups");
	
	if (http_group_request.readyState == 4) {
		if (http_group_request.status == 200) {
			while (http_group_request.responseText == "") {}
			doing.innerHTML = http_group_request.responseText;
		} else {
			doing.innerHTML = "Sto controllando il file...";
		}
	}	
	
}