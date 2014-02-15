<?php

if ( isset($groups["Gestori di Parcheggi"]) ) {
	$page->assign("menu_parcheggio", true);
}
else {
	$page->assign("content","Non si possiedono i privilegi per visualizzare questa sezione.");
}

?>