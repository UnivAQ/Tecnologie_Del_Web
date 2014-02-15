var choose;
/*var http_request;
var menu = null;
var what;
var where;*/

var firstOccurrence = true;
   
   function mySeparator(arg) {
   	
   	if (firstOccurrence) {
   		firstOccurrence = false;
   		return "";
   	} else {
   		return arg;
   	}
   	
   }

function redir(arg,tgt) {
	switch(tgt) {
		default:
		case 0: document.location = arg; break;
		case 1: window.open(arg); break;
	}
}

function loginNow() {
	var form = document.forms["login"];

	if (form.username.value == "") {
		alert("Username non inserita.");
		return;
	}

	if (form.password.value == "") {
		alert("Password non inserita.");
		return;
	}

	form.submit();

}

function saveAsDraft() {
	var form = document.forms["form_contenuto"];

	if ((form.titolo.value == "") && (form.testo.value == "")){
		alert("L'articolo non può essere salvato senza aver riempito almeno un campo.");
		return;
	}

	firstOccurrence = true;
	for (var i = 0; i < form.length; i++) {
		if (matches.test(form[i].name)) {
			if (form[i].checked == true) {
				form.sezioni.value += mySeparator("|") + form[i].value;
			}
		}
	}
	
	form.pubblicato.value = 'N';
	
	firstOccurrence = true;
	if (form.attach) {
		if (form.attach.options.length > 0) {
			for (var i = 0; i < form.attach.options.length; i++) {
				form.selectedFiles.value += mySeparator("|") + form.attach.options[i].text;
			}
		}
	}
	
	form.submit();
}

function publicArticle(arg) {
	var form = document.forms["form_contenuto"];
	var matches = new RegExp("results_([0-9]+)");
	var presenti = 0;
	
	firstOccurrence = true;
	for (var i = 0; i < form.length; i++) {
		if (matches.test(form[i].name)) {
			if (form[i].checked == true) {
				form.sezioni.value += mySeparator("|") + form[i].value;
			}
		}
	}
	
	if (form.titolo.value == "") {
		alert("Titolo non inserito.");
		return;
	}
	
	if (arg == 0) {
		if (form.testo.value == "") {
			alert("Testo non inserito.");
			return;
		}
	}
		
	if (arg == 1) {
		if (frames[0].document.body.innerHTML == "<br>") {
			alert("Testo non inserito.");
			return;
		}
	}
	
	if (form.sezioni.value == "") {
		alert("Non è stata selezionata alcuna sezione.");
		return;
	}
	
	form.pubblicato.value = 'Y';
	
	firstOccurrence = true;
	if (form.attach) {
		if (form.attach.options.length > 0) {
			for (var i = 0; i < form.attach.options.length; i++) {
				form.selectedFiles.value += mySeparator("|") + form.attach.options[i].text;
			}
		}
	}
	
	form.submit();
}

function deleteConfirm(arg) {
	if(confirm("Vuoi veramente cancellare questo elemento?")) {
		document.location = arg;
	} else {
		return;
	}
}

function tip(what,flag) {
	var target_tip = document.getElementById(what + "_tip");
	
	if (what == "pw") {
		switch(flag) {
			default:
			case 0: target_tip.innerHTML = ""; break;
			case 1: target_tip.innerHTML = "(minimo 6, massimo 20 caratteri)"; break;
		}
	}
	
	if (what == "un") {
		switch(flag) {
			default:
			case 0: target_tip.innerHTML = ""; break;
			case 1: target_tip.innerHTML = "(minimo 6, massimo 25 caratteri)"; break;
		}
	}
	
}

function saveAsEditedDraft() {
	var form = document.forms["form_contenuto"];
	var matches = new RegExp("results_([0-9]+)");
	var presenti = 0;
	var sezioniSelezionate = "";
	
	/*if ((form.titolo.value == "") && (form.testo.value == "")){
		alert("L'articolo non può essere salvato senza aver riempito almeno un campo.");
		return;
	}*/
	
	firstOccurrence = true;
	
	for (var i = 0; i < form.length; i++) {
		if (matches.test(form[i].name)) {
			if (form[i].checked == true) {
				form.sezioni.value += mySeparator("|") + form[i].value;
			}
		}
	}

	form.pubblicato.value = 'N';
	firstOccurrence = true;
	
	if (form.attach) {
		if (form.attach.options.length > 0) {
			for (var i = 0; i < form.attach.options.length; i++) {
				form.selectedFiles.value += mySeparator("|") + form.attach.options[i].text;
			}
		}
	}
	
	form.submit();
}

function publicEditedArticle(arg) {
	var form = document.forms["form_contenuto"];
	var matches = new RegExp("sottosezioni_([0-9]+)");
	var presenti = 0;
	var sezioniSelezionate = "";
	
	firstOccurrence = true;
	
	for (var i = 0; i < form.length; i++) {
		if (matches.test(form[i].name)) {
			if (form[i].checked == true) {
				sezioniSelezionate += mySeparator("|") + form[i].value;
			}
		}
	}
	
	if ((sezioniSelezionate != form.sezioni.value) && (sezioniSelezionate != "")) {
		form.sezioni.value = sezioniSelezionate;
	}
	
	firstOccurrence = true;
	
	if (form.titolo.value == "") {
		alert("Titolo non inserito.");
		return;
	}
	
	if (arg == 0) {
		if (form.testo.value == "") {
			alert("Testo non inserito.");
			return;
		}
	}
		
	if (arg == 1) {
		if (frames[0].document.body.innerHTML == "<br>") {
			alert("Testo non inserito.");
			return;
		}
	}
	
	if (form.sezioni.value == "") {
		alert("Non è stata selezionata alcuna sezione.");
		return;
	}
	
	form.pubblicato.value = 'Y';
	
	if (form.attach) {
		if (form.attach.options.length > 0) {
			for (var i = 0; i < form.attach.options.length; i++) {
				form.selectedFiles.value += mySeparator("|") + form.attach.options[i].text;
			}
		}
	}
	form.submit();
}

function updatePosition() {
	var form = document.forms['form_sezioni'];
	
	var trovato;
	
	for (var i=0; i<form.posizione.options.length; i++) {
		if (form.posizione.options[i].value == 0) {
     		trovato = i;
		}
	}
	form.posizione.options[trovato].text = form.nome.value;
	form.posizione.options[trovato].value = 0;
	form.posizione.selectedIndex = trovato;
	
}

function positionUp() {
	var form = document.forms['form_sezioni'];
	
	if (form.posizione.selectedIndex > 0) {
		
		var text = form.posizione.options[form.posizione.selectedIndex-1].text;
		var value = form.posizione.options[form.posizione.selectedIndex-1].value;
		form.posizione.options[form.posizione.selectedIndex-1].text = 
		 	form.posizione.options[form.posizione.selectedIndex].text;
		form.posizione.options[form.posizione.selectedIndex-1].value = 
		 	form.posizione.options[form.posizione.selectedIndex].value;
		form.posizione.options[form.posizione.selectedIndex].text = text;
		form.posizione.options[form.posizione.selectedIndex].value = value;	
		form.posizione.selectedIndex--;
	}
	
}

function positionDown() {
	var form = document.forms['form_sezioni'];
	
	if (form.posizione.selectedIndex < form.posizione.options.length-1) {
		
		var text = form.posizione.options[form.posizione.selectedIndex+1].text;
		var value = form.posizione.options[form.posizione.selectedIndex+1].value;
		form.posizione.options[form.posizione.selectedIndex+1].text = 
		 	form.posizione.options[form.posizione.selectedIndex].text;
		form.posizione.options[form.posizione.selectedIndex+1].value = 
		 	form.posizione.options[form.posizione.selectedIndex].value;
		form.posizione.options[form.posizione.selectedIndex].text = text;
		form.posizione.options[form.posizione.selectedIndex].value = value;	
		form.posizione.selectedIndex++;
	}
}

function addSection() {
	var form = document.forms['form_sezioni'];
	
	if (form.nome.value == "") {
		alert("Nome sezione non inserito.");
		return;
	}
	if (form.descrizione.value == "") {
		alert("Descrizione non inserita.");
		return;
	}
	
	firstOccurence = true;
	form.positionList.value = "";
	for (var i=0; i< form.posizione.options.length; i++) {
		form.positionList.value += mySeparator("|")+form.posizione.options[i].value+":"+(i+1);
		
		if (form.posizione.options[i].value == 0) {
			form.posizione.selectedIndex = i;
		}
	}
	
	alert(form.positionList.value);
	return;
	form.submit();
}

function saveAsHTMLDraft() {
	var form = document.forms["form_contenuto_html"];

	if ((form.titolo.value == "") && (form.userfile.value == "")){
		alert("L'articolo non può essere salvato senza aver riempito almeno un campo.");
		return;
	}
	
	firstOccurrence = true;
	
	for (var i = 0; i < form.length; i++) {
		if (matches.test(form[i].name)) {
			if (form[i].checked == true) {
				form.sezioni.value += mySeparator("|") + form[i].value;
			}
		}
	}

	form.pubblicato.value = 'N';
	
	form.submit();
}

function publicHTMLArticle() {
	var form = document.forms["form_contenuto_html"];
	var matches = new RegExp("results_([0-9]+)");
	var presenti = 0;
	var sezioniSelezionate = "";
	
	firstOccurrence = true;
	
	for (var i = 0; i < form.length; i++) {
		if (matches.test(form[i].name)) {
			if (form[i].checked == true) {
				sezioniSelezionate += mySeparator("|") + form[i].value;
			}
		}
	}
	
	if ((sezioniSelezionate != form.sezioni.value) && (sezioniSelezionate != "")) {
		form.sezioni.value = sezioniSelezionate;
	}
	
	if (form.titolo.value == "") {
		alert("Titolo non inserito.");
		return;
	}
	
	if (form.userfile.value == "") {
		alert("File HTML non definito.");
		return;
	}
	
	if (form.sezioni.value == "") {
		alert("Non è stata selezionata alcuna sezione.");
		return;
	}
	
	form.pubblicato.value = 'Y';
	
	form.submit();
}

function updatePermission() {
	var form = document.forms["form_permessi"];
	form.submit();
}