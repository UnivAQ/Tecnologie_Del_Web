<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

define(UPLOAD_DESTINATION_DIR, "upload/");

$main = new Template("dtml/cms_layout.html");
$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_contenuto_html.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
$content->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY nome"));

// Contenuto

switch($_REQUEST['page']) {
	case 0: 
		$main->setContent("content", $content->get() );		
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}
		
		$message = "&nbsp;&nbsp;Articolo inserito con successo.";
		$esito = "ok";
		do {
			
			if($_FILES['userfile']['type'] != "text/html") {
				$message = "&nbsp;&nbsp;Tipo file non accettato";
				$esito = "ko";
				break;
			}
			
			if($_FILES['userfile']['size'] > 204800) {
				$message = "&nbsp;&nbsp;Il file supera le dimensioni consentite. (Max 200 KB)";
				$esito = "ko";
				break;
			}
			
			if(!move_uploaded_file($_FILES['userfile']['tmp_name'], UPLOAD_DESTINATION_DIR.$_FILES['userfile']['name'])) {
				$message = "&nbsp;&nbsp;File non caricato.";
				$esito = "ko";
				break;
			}
			
			$subsections = explode("|", $_REQUEST['sezioni']);
			
			$today = date('Y-m-d');
			$now = date('H:i:s');
			
			$fid = mysql_query("INSERT INTO file
							 VALUES ('{$_SESSION['user']['username']}',
							 		 '".addslashes($_FILES['userfile']['name'])."',
							 		 '".UPLOAD_DESTINATION_DIR."',
							 		 '{$_FILES['userfile']['type']}',
							 		 '{$_FILES['userfile']['size']}',
							 		 '{$_REQUEST['descrizione']}',
							 		 '".date('H:i:s')."',
							 		 '".date('Y-m-d')."')");
			
			if (!$fid) {
				$message = "&nbsp;&nbsp;File non caricato." . mysql_error();
				$esito = "ko";
				break;
			}
			
			/* Estrazione dell'HTML dal file */
			$testo = extract_html(UPLOAD_DESTINATION_DIR.$_FILES['userfile']['name']);
			$testo = ($_REQUEST['note'] != '' ? $testo . "<br>" . $_REQUEST['note'] : $testo);
			
			$oid = mysql_query("INSERT INTO contenuto
									 VALUES (NULL,
									 		 '{$_SESSION['user']['username']}',
									 		 '{$_REQUEST['titolo']}',
									 		 '{$testo}',
									 		 '{$now}',
									 		 '{$today}',
									 		 '{$now}',
									 		 '{$today}',
									 		 '{$_REQUEST['pubblicato']}',
									 		 1)");
			
			if (!$oid) {
				$message = "&nbsp;&nbsp;Articolo non inserito." . mysql_error();
				$esito = "ko";
				break;
			}
			
			$hid = mysql_query("SELECT id FROM contenuto
								 WHERE (titolo = '{$_REQUEST['titolo']}') 
								 AND (ora_creazione = '$now')
								 AND (data_creazione = '$today')");
			
			$aux = mysql_fetch_assoc($hid);
			
			/* Inserimento SOTTOSEZIONI */
			foreach ($subsections as $key => $value) {
				$suid = mysql_query("INSERT INTO contenuto_sottosezione
										  VALUES ({$aux['id']}, {$value}) ");
			}
			
			$cfid = mysql_query("INSERT INTO contenuto_file VALUES ({$aux['id']},'{$_FILES['userfile']['name']}')");
		
		} while(false);
		
		if($esito == "ok") {
			$main = new Template("dtml/cms_layout.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_form_contenuto.html");
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );
			$content->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY nome"));
			$content->setContent("message", $message, "esito=\"$esito\"");
		} else {
			$content->setContent("message", $message, "esito=\"$esito\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>