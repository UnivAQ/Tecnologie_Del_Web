<?php

if ( $authn->isAuthn() ) 
{
	try 
	{
		$messaggio = new Messaggio(string_clean($_REQUEST["messaggio_id"]));
		$messaggio->populate($database);
	}
	catch ( Exception $e ) 
	{
		die("FATAL ERROR: " . $e->getMessagge());
	}
	
	if ( ($messaggio->getIdDestinatario() == $user->getId()) || ($messaggio->getIdMittente() == $user->getId()) ) 
	{
		try 
		{
			$messaggio->delete($database);
		}
		catch ( Exception $e ) 
		{
			die("FATAL ERROR: " . $e->getMessage());
		}
		 
		$page->assign("content", "Caro " . $user->getUsername() . " il messaggio &egrave; stato cancellato.");
	}
}	
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}

?>
