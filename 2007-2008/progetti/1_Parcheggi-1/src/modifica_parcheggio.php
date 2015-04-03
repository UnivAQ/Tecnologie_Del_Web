<?php 
if ( $authn->isAuthn() ) 
{
	try {
		$parcheggio = new Parcheggio(string_clean($_REQUEST["parcheggio_id"]));
		$parcheggio->populate($database);
	}
	catch ( Exception $e ) {
	die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( $user->getId() == $parcheggio->getIdProprietario() ) 
	{
		$parcheggio_mod = $parcheggio;
	}
	else if ( $authz->getPerm("Parcheggio") >= 2 ) 
	{
		$parcheggio_mod = $parcheggio;
		$page->assign("read_only", true);
	}
	else {
		die("FATAL ERROR: non &egrave; possibile modificare il parcheggio selezionato.");
	}
	
	if ( !isset($_REQUEST["step"]) )
	{
		$page->assign("nome", $parcheggio->getNome());
		$indirizzo = new Indirizzo($parcheggio->getIdIndirizzo());
		$indirizzo->populate($database);
		$page->assign("via", $indirizzo->getVia());
		$page->assign("civico", $indirizzo->getCivico());
		$page->assign("comune", $indirizzo->getComune());
		$page->assign("provincia", $indirizzo->getProvincia());
		$page->assign("cap", $indirizzo->getCap());
		$page->assign("lat", $indirizzo->getLat());
		$page->assign("lon", $indirizzo->getLon());
		
		$page->assign("modifica_parcheggio", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler modificare il parcheggio?");
		$page->assign("parcheggio_id", $parcheggio_mod->getId());
	}
	
	else 
	{
		try {
			$parcheggio_mod->setNome($_REQUEST["nome"]);
			$parcheggio_mod->setProprietario($user);
			
			/* Controllo se esiste gia' un indirizzo uguale nel db */
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
				
				$parcheggio_mod->setIndirizzo($indirizzo);
			}
			else {
				try {
					if ( $database->count("id_indirizzo", "Utente", "id_indirizzo = " . $parcheggio_mod->getIdIndirizzo()) > 1 ) {
						$indirizzo = new Indirizzo();
					}
					else {
						$indirizzo = new Indirizzo($parcheggio_mod->getIdIndirizzo());
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
				
				$parcheggio_mod->setIndirizzo($indirizzo);
			}
			
			$parcheggio_mod->save($database);
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$query = $indirizzo->getVia() . "+" . $indirizzo->getCivico() . "+" . $indirizzo->getComune() . "+" . $indirizzo->getProvincia() . "+" . $indirizzo->getCap() . "+Italy";
		$query = urlencode(str_replace(" ", "+", $query));
		$url = fopen("http://maps.google.com/maps/geo?q=" . $query . "&key=METTILAKEY&output=csv", "r");
		$temp = fread($url, 1024);
		fclose($url);
		
		try {
			$explosion = explode(",", $temp);
			$lat = $explosion[2];
			settype($lat, "float");
			$lon = $explosion[3];
			settype($lon, "float");
			
			$indirizzo->populate($database);
			
			$indirizzo->setLat($lat);
			$indirizzo->setLon($lon);
			$indirizzo->save($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}	
		
		$page->assign("content","Il parcheggio \"".$parcheggio_mod->getNome()."\" &egrave stato modificato!");
	}	
}
else 
{
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per potere accedere a questa sezione.");
}

?>
