<?php

if ( $authn->isAuthn() ) 
{
	if ( ! isset($_REQUEST["step"]) )
    {
		$page->assign("aggiungi_carta", true);
	}
	else 
	{
		try 
		{
			$database->setQuery("SELECT id FROM Carta_Credito WHERE numero = '" . string_clean($_REQUEST["numero"]) . "' LIMIT 1");
			$database->query();
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() == 1 ) 
		{
			$temp = $database->getData();
			$carta = new carta_credito($temp->id);
			$carta->populate($database);
		}
		else
		{
			$carta = new carta_credito();
			try 
			{
			$carta->setTipo($_REQUEST["tipo"]);
			$carta->setNumero($_REQUEST["numero"]);
			$carta->setC_Sic($_REQUEST["c_sic"]);
			$carta->setIntestatario($_REQUEST["intestatario"]);
			$carta->setUtente($user);
			
			$carta->save($database);
			}
			catch ( Exception $e ) 
			{
				die("FATAL ERROR: " . $e->getMessage());
			}
			
			$page->assign("content", "Caro " . $user->getUsername() . ", la carta di credito &egrave; stata aggiunta con successo.");
		}
	}

}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter aggiungere carte di credito.");
	}	

?>