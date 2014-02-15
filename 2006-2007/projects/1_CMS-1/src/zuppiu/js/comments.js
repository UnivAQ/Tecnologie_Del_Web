var http_comment_request;

function leaveComment() {
	var form = document.forms["form_commenti"];
	
	if (form.nome.value == "") {
		alert("Nome non inserito.");
		return;
	}
	
	if (form.email.value == "") {
		alert("Indirizzo Email non inserito.");
		return;
	}
	
	if (form.testo.value == "") {
		alert("Testo non inserito.");
		return;
	}
	
	http_comment_request = false;
	if (window.XMLHttpRequest) {
		http_comment_request= new XMLHttpRequest();
		if (http_comment_request.overrideMimeType) {
			http_comment_request.overrideMimeType('text/xml');
		}
	} else if (window.ActiveXObject) {
		try {http_comment_request= new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			http_comment_request= new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
		}
	} if (!http_comment_request) {
		alert("E' stato riscontrato un problema nella connessione al server.");
		return false;
	}
	var comment = 'nome=' + form.nome.value + "&email=" + form.email.value + "&url=" + form.url.value + "&testo=" + form.testo.value + "&id=" + form.id.value;
	http_comment_request.onreadystatechange = showComments;
	http_comment_request.open('POST', 'zuppiu_comment_add.php', true);
	http_comment_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http_comment_request.send(comment);
}

function showComments() {
	var doing = document.getElementById("usercomments");
	var form = document.forms["form_commenti"];
	
	if (http_comment_request.readyState == 4) {
		if (http_comment_request.status == 200) {
			while (http_comment_request.responseText == "") {}
			doing.innerHTML = http_comment_request.responseText;
		} else {
			doing.innerHTML = "Sto inserendo il commento...";
		}
	}	
	
	form.nome.value = "";
	form.email.value = "";
	form.url.value = "";
	form.testo.value = "";
	
}