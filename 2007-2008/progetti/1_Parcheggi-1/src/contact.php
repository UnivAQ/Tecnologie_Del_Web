<?php

	if ( isset($_REQUEST["step"]) )
	{
		$nome = string_clean($_REQUEST["nome"]);
		$email = string_clean($_REQUEST["email"]);
		$oggetto = string_clean($_REQUEST["oggetto"]);
		$richiesta = string_clean($_REQUEST["contact"]);
	
	//	mail("webmaster@{$_SERVER['SERVER_NAME']}",
	//		  $oggetto,
	//		  $richiesta,
	//		  "Reply to: " . $nome . "Email: " . $email);
		  
		$page->assign("content", "Richiesta inviata. Grazie di averci contattato");
	}
	else
	{
		$page->assign("contact", true);
	}
?>