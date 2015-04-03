<?php

if ( $authn->isAuthn() ) {
	if ( !isset($_REQUEST["step"]) ) {
		try {
			$database->setQuery("SELECT t1.id, t1.targa, t2.marca, t2.nome FROM Automezzo AS t1, Modello AS t2 WHERE (t1.id_modello = t2.id) AND (t1.id_utente = " . $user->getId() . ")");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$auto_array = array();
		
		for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
			$temp = $database->getData();
			$auto_array["{$temp->id}"] = array("targa" => string_soil($temp->targa), "marca" => string_soil($temp->marca), "nome" => string_soil($temp->nome));
		}
		
		try {
			$database->setQuery("SELECT id, tipo, numero FROM Carta_Credito WHERE id_utente = " . $user->getId());
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$carte_array = array();
		
		for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
			$temp = $database->getData();
			$carte_array["{$temp->id}"] = array("tipo" => string_soil($temp->tipo), "numero" => string_soil($temp->numero));
		}
		
		$page->assign("messaggio_sicurezza", "Per prenotare questa sosta è necessario confermare.");
		$page->assign("prenota_sosta", true);
		$page->assign("step", 0);
		$page->assign("auto_array", $auto_array);
		$page->assign("carte_array", $carte_array);
		$page->assign("parcheggio_id", string_clean($_REQUEST["parcheggio_id"]));
	}
	else if ( string_clean($_REQUEST["step"]) == "0" ) {
		$parcheggio = new Parcheggio(string_clean($_REQUEST["parcheggio_id"]));
		$auto = new Automezzo(string_clean($_REQUEST["auto"]));
		
		try {
			$parcheggio->populate($database);
			$auto->populate($database);
			
			$modello = new Modello($auto->getIdModello());
			$modello->populate($database);
			
			$arrivo = mktime(string_clean($_REQUEST["ora_a"]), 0, 0, string_clean($_REQUEST["mese_a"]), string_clean($_REQUEST["giorno_a"]), string_clean($_REQUEST["anno_a"]));
			$partenza = mktime(string_clean($_REQUEST["ora_p"]), 0, 0, string_clean($_REQUEST["mese_p"]), string_clean($_REQUEST["giorno_p"]), string_clean($_REQUEST["anno_p"]));
			
			$database->setQuery("SELECT id, totale, tariffa_oraria FROM Posto_Auto WHERE ( larghezza >= ". $modello->getLarghezza() . " AND lunghezza >= " . $modello->getLunghezza() . " AND altezza >= " . $modello->getAltezza() . ") ORDER BY tariffa_oraria");
			$database->query();
			$posti = array();
			
			for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
				$temp = $database->getData();
				$posti[] = array("id" => string_soil($temp->id), "totale" => string_soil($temp->totale), "tariffa" => string_soil($temp->tariffa_oraria));
			}
			
			$prenotato = false;
			
			for ( $i = 0; $i < count($posti); $i++ ) {
				if ( $database->count("id", "R10", "(arrivo >= '" . date("Y-m-d G:i:s", $arrivo) . "' AND arrivo <= '" . date("Y-m-d G:i:s", $partenza) . "') OR (partenza >= '" . date("Y-m-d G:i:s", $arrivo) . "' AND partenza <= '" . date("Y-m-d G:i:s", $partenza) . "')") < $posti[$i]["totale"] ) {
					$database->setQuery("INSERT INTO R10 (arrivo, partenza, id_automezzo, id_posto_auto) VALUES ('" . date("Y-m-d G:i:s", $arrivo) . "', '" . date("Y-m-d G:i:s", $partenza) . "', " . $auto->getId() . ", {$posti[$i]["id"]})");
					$database->query();
					
					if ( $database->getResultsNumber() == 1 ) {
						$prenotato = true;
						break;
					}
				}
			}
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $prenotato ) {
			$page->assign("content", "Posto auto prenotato, spesi " . (($partenza - $arrivo) / 3600) *  $posti[$i]["tariffa"] . " EUR.");
		}
		else {
			$page->assign("content", "Siamo spiacenti ma non ci sono posti disponibili.");
		}
	}
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma bisogna essere autenticati per poter accedere a questa sezione.");
}

?>