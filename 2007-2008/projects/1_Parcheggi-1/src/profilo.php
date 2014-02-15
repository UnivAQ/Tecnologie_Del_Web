<?php

if ( $authn->isAuthn() ) {
	$page->assign("menu_profilo", true);
	$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare il proprio profilo?");
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}

?>