<?php
if ( $authn->isAuthn() ) 
{	
	try
	{
	$parcheggio = new Parcheggio($_REQUEST["parcheggio_id"]);
	$parcheggio->populate($database);
	}
	catch ( Exception $e ) {
	die("FATAL ERROR: " . $e->getMessage());
	}
	$page->assign("parcheggio_id", $parcheggio->getId());
	if ( ! isset($_REQUEST["step"]) )
    {
		$page->assign("aggiungi_postoauto", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler aggiungere i posti?");
		$page->assign("parcheggio_id", $parcheggio->getId());
	}
	else 
	{
		$postoauto = new PostoAuto();
		try 
		{
		
			$totale = $_REQUEST["totale"];
			settype($totale, "int");
			$postoauto->setTotale($totale);
			$larghezza = $_REQUEST["larghezza"];		
			$larghezza = str_replace(",", ".", $larghezza);
			settype($larghezza, "float");
			$postoauto->setLarghezza($larghezza);
			$lunghezza = $_REQUEST["lunghezza"];		
			$lunghezza = str_replace(",", ".", $lunghezza);
			settype($lunghezza, "float");
			$postoauto->setLunghezza($lunghezza);
			$altezza = $_REQUEST["altezza"];		
			$altezza = str_replace(",", ".", $altezza);
			settype($altezza, "float");
			$postoauto->setAltezza($altezza);
			$tariffa = $_REQUEST["tariffa_oraria"];		
			$tariffa = str_replace(",", ".", $tariffa);
			settype($tariffa, "float");
			$postoauto->setTariffa($tariffa);
			$postoauto->setParcheggio($parcheggio);
			
			$postoauto->save($database);
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
			 
		$page->assign("content", "Caro " . $user->getUsername() . ", i posti auto sono stati aggiunti con successo.");

	}
}
else 
{
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati come gestore per poter aggiungere posti auto.");
}
?>