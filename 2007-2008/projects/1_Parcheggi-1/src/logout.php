<?php

if ( $authn->isAuthn() ) {
	$page->assign("content", "Arrivederci {$user->getUsername()}.");
}
else {
	$page->assign("content", "Non è possibile effettuare la procedura di logout se non si è effettuata quella di login.");
}

$close_session = true;

?>
