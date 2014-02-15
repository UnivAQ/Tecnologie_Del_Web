<?php
if ( $authn->isAuthn() ) 
{
	$risultati = false;
	
	try 
	{	
		if ( $authz->getPerm("Parcheggio") >= 2 && !isset($_REQUEST["my"]) && !isset($_REQUEST["preferiti"]) ) 
		{
			$database->setQuery("SELECT nome,id_indirizzo,id FROM Parcheggio ORDER BY id");
		}
		else if ( isset($_REQUEST["preferiti"]) ) {
			$database->setQuery("SELECT id, nome FROM Parcheggio WHERE id IN (SELECT DISTINCT id_parcheggio FROM R12 WHERE id_utente = " . $user->getId() . ")");
			$page->assign("preferiti", true);
		}
		else 
		{
			$database->setQuery("SELECT nome,id_indirizzo,id FROM Parcheggio WHERE id_utente = " . $user->getId() . " ORDER BY id");
			$page->assign("my", true);
		}
		$database->query();
	}
	catch ( Exception $e ) 
	{
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$parcheggi_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) 
	{
		$temp = $database->getData();
		$parcheggi_array["{$temp->id}"] = string_soil($temp->nome);
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("lista_parcheggi", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare questo parcheggio?");
		$page->assign("parcheggi_array", $parcheggi_array);
	}
	else {
		$page->assign("content", "Non ci sono parcheggi.");
	}
}

else 
{
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}


?>