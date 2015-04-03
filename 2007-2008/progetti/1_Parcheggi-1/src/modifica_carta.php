<?php
if ( $authn->isAuthn() ) 
{
	
	$carta = new carta_credito(string_clean($_REQUEST["carta_id"]));
	try 
		{
		$carta->populate($database);
		}
		catch ( Exception $e ) 
		{
		die("FATAL ERROR: " . $e->getMessage());
		}
	
	if ( $user->getId() == $carta->getId_Utente() ) 
	{
		$carta_mod = $carta;
	}
	else if ( $authz->getPerm("Carta") >= 4 ) {
		$carta_mod = $carta;
		$page->assign("read_only", true);
	}
	else {
		die("FATAL ERROR: non &egrave; possibile modificare la carta selezionata.");
	}
	
	if ( !isset($_REQUEST["step"]) )
	{
		$page->assign("numero", $carta->getNumero());
		$page->assign("tipo", $carta->getTipo());
		$page->assign("c_sic", $carta->getC_Sic());
		$page->assign("intestatario", $carta->getIntestatario());
		
		$page->assign("modifica_carta", true);
		$page->assign("messaggio_sicurezza", "Confermi la modifica della carta di credito?");
		$page->assign("carta_id", $carta_mod->getId());
	}
	
	else 
	{
		$carta_mod->setNumero($_REQUEST["numero"]);
		$carta_mod->setTipo($_REQUEST["tipo"]);
		$carta_mod->setC_Sic($_REQUEST["c_sic"]);
		$carta_mod->setIntestatario($_REQUEST["intestatario"]);
		
		try 
		{
			$carta_mod->save($database);
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content","La carta numero # ".$carta_mod->getNumero()." &egrave stata modificata!");
	}	
}
else 
{
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per potere accedere a questa sezione.");
}
	
?>