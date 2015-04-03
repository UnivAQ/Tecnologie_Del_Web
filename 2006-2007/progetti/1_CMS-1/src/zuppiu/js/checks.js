function checkFields(type,formname) {
	var form = document.forms[formname];
	
	if(type == "link") {
		if(form.nome.value == "") {
			alert("Nome collegamento non inserito.");
			return;
		}
		if(form.url.value == "") {
			alert("URL non inserito.");
			return;
		}
	}
	
	if(type == "utente") {
		/* Controlli di consistenza */
		if(form.username.value == "") {
			alert("Username non inserito. Campo obbligatorio.");
			return;
		}
		if(form.password.value == "") {
			alert("Password non inserita. Campo obbligatorio.");
			return;
		}
		if(form.password_confirm.value == "") {
			alert("Conferma password mancante. Campo obbligatorio.");
			return;
		}
		if(form.gruppo.options[form.gruppo.selectedIndex].value == "") {
			alert("Selezionare il gruppo d'appartenenza dell'utente.");
			return;
		}
		if(form.nome.value == "") {
			alert("Nome non inserito. Campo obbligatorio.");
			return;
		}
		if(form.cognome.value == "") {
			alert("Cognome non inserito. Campo obbligatorio.");
			return;
		}
		if(form.email.value == "") {
			alert("Email non inserita. Campo obbligatorio");
			return;
		}
		if(form.telefono_fisso.value == "") {
			alert("Telefono non inserito. Campo obbligatorio");
			return;
		}
		
		/* Controlli di congruenza */
		if((form.username.value.length < 6) || (form.username.value.length > 25)) {
			alert("Lunghezza username errata.\nMinimo 6, massimo 25 caratteri.");
			return;
		}
		if((form.password.value.length < 6) || (form.password.value.length > 20)) {
			alert("Lunghezza password errata.\nMinimo 6, massimo 20 caratteri.");
			return;
		}
		if(form.password.value != form.password_confirm.value) {
			alert("Password e Conferma Password non coincidono.");
			return;
		}
		if(form.url.value == "http://") {
			form.url.value = "";
		}
	}
	
	if(type == "utente_modifica") {
		/* Controlli di consistenza */
		if(form.username.value == "") {
			alert("Username non inserito. Campo obbligatorio.");
			return;
		}
		if(form.nome.value == "") {
			alert("Nome non inserito. Campo obbligatorio.");
			return;
		}
		if(form.cognome.value == "") {
			alert("Cognome non inserito. Campo obbligatorio.");
			return;
		}
		if(form.email.value == "") {
			alert("Email non inserita. Campo obbligatorio");
			return;
		}
		if(form.telefono_fisso.value == "") {
			alert("Telefono non inserito. Campo obbligatorio");
			return;
		}
		
		/* Controlli di congruenza */
		if((form.password.value != "") && ((form.password.value.length < 6) || (form.password.value.length > 20))) {
			alert("Lunghezza password errata.\nMinimo 6, massimo 20 caratteri.");
			return;
		}
		if(form.password.value != form.password_confirm.value) {
			alert("Password e Conferma Password non coincidono.");
			return;
		}
		if(form.url.value == "http://") {
			form.url.value = "";
		}
	}
	
	if (type == "features") {
		if(form.nomeservizio.value == "") {
			alert("Nome servizio non inserito.");
			return;
		}
		if(form.descrizione.value == "") {
			alert("Descrizione non inserita.");
			return;
		}
		if(form.responsabile.value == "") {
			alert("Responsabile non inserito.");
			return;
		}
	}
	
	form.submit();
}