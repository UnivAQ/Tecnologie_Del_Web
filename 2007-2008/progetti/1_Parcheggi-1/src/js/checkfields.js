function reg_user()
{
	
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var nome = document.regUserForm.nome;
	var cognome = document.regUserForm.cognome;
	var l_nascita = document.regUserForm.l_nascita;
	var username = document.regUserForm.username;
	var password = document.regUserForm.password;
	var password2 = document.regUserForm.password2;
	var email = document.regUserForm.email;
	var via = document.regUserForm.via;
	var civico = document.regUserForm.civico;
	var comune = document.regUserForm.comune;
	var provincia = document.regUserForm.provincia.options[document.regUserForm.provincia.selectedIndex];
	var cap = document.regUserForm.cap;
	
	elemArray = new Array(nome, cognome, l_nascita, username, password, password2, email, via, civico, comune, provincia, cap);
	
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (echeck(email.value) == false)
	{
		e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont += '<b>* Formato email errato !</b><br>';

	}
	
	if (password.value != password2.value)
	{
		e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont += '<b>* Inserisci correttamente la password</b><br><br>';
	}
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function echeck(str) 
{
		var at = "@";
		var dot = ".";
		var lat = str.indexOf(at);
		var lstr = str.length;
		var ldot = str.indexOf(dot);
		
		if (str.indexOf(at)==-1)
		   return false;

		if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr)
		   return false;
	

		if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr)
		    return false;
		

		 if (str.indexOf(at,(lat+1)) != -1)
		    return false;
		 

		 if (str.substring(lat-1,lat) == dot || str.substring(lat+1,lat+2) == dot)
		    return false;
		 

		 if (str.indexOf(dot,(lat+2)) == -1)
		    return false;
		 
		
		 if (str.indexOf(" ") != -1)
		    return false;
		 

 		 return true;
}

function add_carta() {
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var intestatario = document.cartaForm.intestatario;
	var numero = document.cartaForm.numero;
	var codice = document.cartaForm.c_sic;
	
	elemArray = new Array(intestatario, numero, codice);
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function mod_user()
{
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var nome = document.regUserForm.nome;
	var cognome = document.regUserForm.cognome;
	var l_nascita = document.regUserForm.l_nascita;
	var password = document.regUserForm.password;
	var password2 = document.regUserForm.password2;
	var email = document.regUserForm.email;
	var via = document.regUserForm.via;
	var civico = document.regUserForm.civico;
	var comune = document.regUserForm.comune;
	var provincia = document.regUserForm.provincia.options[document.regUserForm.provincia.selectedIndex];
	var cap = document.regUserForm.cap;
	
	elemArray = new Array(nome, cognome, l_nascita, email, via, civico, comune, provincia, cap);
	
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (echeck(email.value) == false)
	{
		e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont += '<b>* Formato email errato !</b><br>';

	}
	
	if (password.value != password2.value)
	{
		e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont += '<b>* Inserisci correttamente la password</b><br><br>';
	}
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function reg_auto() {
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var marca = document.autoForm.marca;
	var modello = document.autoForm.modello;
	var targa = document.autoForm.targa;
	var larghezza = document.autoForm.larghezza;
	var lunghezza = document.autoForm.lunghezza;
	var altezza = document.autoForm.altezza;
	
	elemArray = new Array(marca, modello, targa, larghezza, lunghezza, altezza);
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function reg_posto() {
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var totale = document.postoForm.totale;
	var tariffa = document.postoForm.tariffa_oraria;
	var larghezza = document.postoForm.larghezza;
	var lunghezza = document.postoForm.lunghezza;
	var altezza = document.postoForm.altezza;
	
	elemArray = new Array(totale, tariffa, larghezza, lunghezza, altezza);
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function reg_annuncio() {
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var titolo = document.annuncioForm.titolo;
	var corpo = document.annuncioForm.corpo;
	
	elemArray = new Array(titolo, corpo);
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function reg_park() {
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var nome = document.parkForm.nome;
	var via = document.parkForm.via;
	var civico = document.parkForm.civico;
	var comune = document.parkForm.comune;
	var provincia = document.parkForm.provincia.options[document.parkForm.provincia.selectedIndex];
	var cap = document.parkForm.cap;
	
	elemArray = new Array(nome, via, civico, comune, provincia, cap);
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}

function sosta_reg() {
	var e = document.getElementById('errmsg');
	e_cont = '';
	$err1 = false;
	
	var auto = document.sostaForm.auto.options[document.sostaForm.auto.selectedIndex];
	var carta = document.sostaForm.carta.options[document.sostaForm.carta.selectedIndex];
		
	elemArray = new Array(auto, carta);
	
	for (i = 0; i < elemArray.length; i++)
	{
		if ( (elemArray[i].value == null) || (elemArray[i].value == "") )
		{
			$err1 = true;
			break;
		}
		elemArray[i].value == 'rock';
	}
	
	if ($err1) 
	{
        e.style.visibility = 'visible';
        e.style.display = 'block';
        e_cont = '<b>* Inserisci tutti i dati !</b><br>';
    }
	
	if (e_cont != '')
	{
		e.innerHTML = e_cont;
		return false;
	}
	else
		return true;
}