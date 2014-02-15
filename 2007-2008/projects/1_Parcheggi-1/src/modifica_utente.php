<?php

if ( $authn->isAuthn() ) {
	if ( $user->getId() == string_clean($_REQUEST["id"]) ) {
		$user_mod = $user;
	}
	else if ( $authz->getPerm("Utente") >= 4 ) {
		$user_mod = new Utente($_REQUEST["id"]);
		try {
			$user_mod->populate($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("read_only", true);
	}
	else {
		die("FATAL ERROR: non &egrave; possibile modificare l'utente.");
	}
	/* Mostro i dati correnti */
	if ( !isset($_REQUEST["step"]) ) {
		$page->assign("modifica_utente", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler modificare i dati?");
		$page->assign("mod_id", $user_mod->getId());
		
		$page->assign("nome", $user_mod->getNome());
		$page->assign("cognome", $user_mod->getCognome());
		$page->assign("l_nascita", $user_mod->getLNascita());
		$page->assign("g_nascita", $user_mod->getGNascita());
		$page->assign("giorno", $user_mod->getGNascita());
		$page->assign("m_nascita", $user_mod->getMNascita());
		$page->assign("mese", $user_mod->getMNascita());
		$page->assign("a_nascita", $user_mod->getANascita());
		$page->assign("anno", $user_mod->getANascita());
		$page->assign("email", $user_mod->getEmail());
		
		$indirizzo = new Indirizzo($user_mod->getIdIndirizzo());
		
		try {
			$indirizzo->populate($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("via", $indirizzo->getVia());
		$page->assign("civico", $indirizzo->getCivico());
		$page->assign("comune", $indirizzo->getComune());
		$page->assign("provincia", $indirizzo->getProvincia());
		$page->assign("cap", $indirizzo->getCap());
	}
	/* Modifico i dati */
	else {
		try {
			$user_mod->setNome($_REQUEST["nome"]);
			$user_mod->setCognome($_REQUEST["cognome"]);
			$user_mod->setLNascita($_REQUEST["l_nascita"]);
			$a_nascita = $_REQUEST["a_nascita"];
			settype($a_nascita, "integer");
			$m_nascita = $_REQUEST["m_nascita"];
			settype($m_nascita, "integer");
			$g_nascita = $_REQUEST["g_nascita"];
			settype($g_nascita, "integer");
			$user_mod->setDNascita($a_nascita, $m_nascita, $g_nascita);
			
			if ( string_clean($_REQUEST["password"]) != "" ) {
				$user_mod->setPassword($_REQUEST["password"]);
			}
			$user_mod->setEmail($_REQUEST["email"]);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}	
		
		try {
			$database->setQuery("SELECT id FROM Indirizzo WHERE via = '" . string_clean($_REQUEST["via"]) . "' AND n_civico = '" . string_clean($_REQUEST["civico"]) . "' AND cap = '" . string_clean($_REQUEST["cap"]) . "' LIMIT 1");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() == 1 ) {
			$temp = $database->getData();
			$indirizzo = new Indirizzo($temp->id);
			
			try {
				$indirizzo->populate($database);
				
				if ( !($database->count("id_indirizzo", "Utente", "id_indirizzo = " . $user_mod->getIdIndirizzo()) > 1) ) {
					$indirizzo_del = new Indirizzo($user_mod->getIdIndirizzo());
					$user_mod->setIndirizzo($indirizzo);
					
					$user_mod->save($database);
					$indirizzo_del->delete($database);
				}
			}
			catch ( Exception $e ) {
				die("FATAL ERRROR: " . $e->getMessage());
			}
		}
		else {
			try {
				if ( $database->count("id_indirizzo", "Utente", "id_indirizzo = " . $user_mod->getIdIndirizzo()) > 1 ) {
					$indirizzo = new Indirizzo();
				}
				else {
					$indirizzo = new Indirizzo($user_mod->getIdIndirizzo());
				}
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
			
			try {
				$indirizzo->setVia($_REQUEST["via"]);
				$indirizzo->setCivico($_REQUEST["civico"]);
				$indirizzo->setComune($_REQUEST["comune"]);
				$indirizzo->setProvincia($_REQUEST["provincia"]);
				$indirizzo->setCap($_REQUEST["cap"]);
				
				$indirizzo->save($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
			
			$user_mod->setIndirizzo($indirizzo);
			
			try {
				$user_mod->save($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}	
		}
		
		$page->assign("content", "L'utente &egrave; stato correttamente modificato.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per potere accedere a questa sezione.");
}

?>