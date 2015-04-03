<?php
if ( $authn->isAuthn() ) 
{	
	try 
	{
		$parcheggio = new Parcheggio($_REQUEST["parcheggio_id"]);
		$parcheggio->populate($database);
		$postoauto = new PostoAuto($_REQUEST["postoauto_id"]);
		$postoauto->populate($database);
		//var_dump($postoauto);
	}
	catch ( Exception $e ) 
	{
	die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( $user->getId() == $parcheggio->getIdProprietario() ) 
	{
		$parcheggio_mod = $parcheggio;
		$postoauto_mod = $postoauto;
		
	}
	else 
	{
		$page->assign("read_only", true);
	}
	
	if ( ! isset($_REQUEST["step"]) )
    {
		$page->assign("totale", $postoauto->getTotale());
		$page->assign("larghezza", $postoauto->getLarghezza());
		$page->assign("lunghezza", $postoauto->getLunghezza());
		$page->assign("altezza", $postoauto->getAltezza());
		$page->assign("tariffa_oraria", $postoauto->getTariffa());
		
		$page->assign("modifica_postoauto", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler modificare i posti auto?");
		$page->assign("parcheggio_id", $parcheggio->getId());
		$page->assign("postoauto_id", $postoauto->getId());
		
	}
	else
	{
		try
		{	
			
			$totale = $_REQUEST["totale"];
			settype($totale, "int");
			$postoauto_mod->setTotale($totale);
			$larghezza = $_REQUEST["larghezza"];		
			$larghezza = str_replace(",", ".", $larghezza);
			settype($larghezza, "float");
			$postoauto_mod->setLarghezza($larghezza);
			$lunghezza = $_REQUEST["lunghezza"];		
			$larghezza = str_replace(",", ".", $lunghezza);
			settype($lunghezza, "float");
			$postoauto_mod->setLunghezza($lunghezza);
			$altezza = $_REQUEST["altezza"];		
			$altezza = str_replace(",", ".", $altezza);
			settype($altezza, "float");
			$postoauto_mod->setAltezza($altezza);
			$tariffa = $_REQUEST["tariffa_oraria"];		
			$tariffa = str_replace(",", ".", $tariffa);
			settype($tariffa, "float");
			$postoauto_mod->setTariffa($tariffa);
			$postoauto_mod->setParcheggio($parcheggio);
			//var_dump($postoauto);
			//var_dump($postoauto_mod);
			$postoauto_mod->save($database);
			var_dump($postoauto_mod);
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
	}
}
else 
{
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per potere accedere a questa sezione.");
}
?>