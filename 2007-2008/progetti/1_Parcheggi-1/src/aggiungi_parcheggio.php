<?php
if ( $authn->isAuthn() && $authz->getPerm("Parcheggio") >= 1 ) {
	if ( ! isset($_REQUEST["step"]) ) 
	{
		$page->assign("aggiungi_parcheggio", true);
	}
	else 
	{
		try
		{
			$database->setQuery("SELECT id FROM Indirizzo WHERE via = '" . string_clean($_REQUEST["via"]) . "' AND n_civico = '" . string_clean($_REQUEST["civico"]) . "' AND cap = '" . string_clean($_REQUEST["cap"]) . "' LIMIT 1");
			$database->query();
		}
		catch ( Exception $e )
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() != 1 ) 
		{
			try 
			{
				$indirizzo = new Indirizzo();
				$via = $_REQUEST["via"];
				$civico = $_REQUEST["civico"];
				$comune = $_REQUEST["comune"];
				$provincia = $_REQUEST["provincia"];
				$cap = $_REQUEST["cap"];
				
				$indirizzo->setVia($via);
				$indirizzo->setCivico($civico);
				$indirizzo->setComune($comune);
				$indirizzo->setProvincia($provincia);
				$indirizzo->setCap($cap);
				
				$indirizzo->save($database);
			}
		    catch ( Exception $e )
		    {
				die("FATAL ERROR: " . $e->getMessage());
			}
		}
		else
		{
			$temp = $database->getData();
			try {
				$indirizzo = new Indirizzo($temp->id);
				$indirizzo->populate($database);
			}
			catch ( Exception $e ) 
			{
				die("FATAL ERROR: " . $e->getMessage());
			}
		}
		
		$parcheggio = new Parcheggio();
		
		try 
		{
			$parcheggio->setNome($_REQUEST["nome"]);
			$parcheggio->setIndirizzo($indirizzo);
			$parcheggio->setProprietario($user);
			
			$parcheggio->save($database);
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $indirizzo->getLat() == 0 && $indirizzo->getLon() == 0 ) {
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
				
				$indirizzo->setLat($lat);
				$indirizzo->setLon($lon);
				$indirizzo->save($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
		}
		
		$page->assign("content", "Caro " . $user->getUsername() . ", il parcheggio &egrave; stato aggiunto con successo.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere gestori di parcheggio per poter aggiungere parcheggi.");
}
?>
