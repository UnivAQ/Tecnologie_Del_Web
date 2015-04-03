<?php
if ( $authn->isAuthn() ) 
{
	if ( isset($_REQUEST["parcheggio_id"]) )
	{
		$parcheggio = new Parcheggio($_REQUEST["parcheggio_id"]);
		$parcheggio->populate($database);
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
	
	
	
	try 
	{
		$database->setQuery("SELECT * FROM Posto_Auto WHERE id_parcheggio = '{$parcheggio->getId()}' ORDER BY id");
		$database->query();
	}
	catch ( Exception $e ) 
	{
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$postoauto_array = array();
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) 
	{
		$temp = $database->getData();
		$postoauto_array["{$temp->id}"] = "#" . string_soil($temp->totale)." posti ".string_soil($temp->larghezza)."x".string_soil($temp->lunghezza)."x".string_soil($temp->altezza);
		$risultati = true;
	}
	
	$page->assign("lista_postoauto", true);
	$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare i posti auto?");
	$page->assign("parcheggio_id", $parcheggio->getId());
	$page->assign("postoauto_array", $postoauto_array);
}
else 
{
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}
?>