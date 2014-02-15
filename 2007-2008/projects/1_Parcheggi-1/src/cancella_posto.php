<?php
if ( $authn->isAuthn() ) {
	
	$parcheggio = new Parcheggio(string_clean($_REQUEST["parcheggio_id"]));
	$postoauto = new PostoAuto(string_clean($_REQUEST["postoauto_id"]));
	try {
		$parcheggio->populate($database);
		$postoauto->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( !($parcheggio->getIdProprietario() == $user->getId())) 
	{
		$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per eliminare questi posti auto.");
	}
	else
	{
		echo("ciao");
		$postoauto->delete($database);
		$page->assign("content", "Posti con id #" . $postoauto->getId() . " eliminati.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}
?>