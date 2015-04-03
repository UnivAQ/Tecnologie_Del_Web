<?

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_comments_response.html");

$contenuto = $_REQUEST['id'];
foreach ($_REQUEST as $key => $value) {
	$_REQUEST[$key] = addslashes($value);
}

$oid = mysql_query("INSERT INTO commento
						 VALUES (NULL,
						 		 '{$_REQUEST['nome']}',
						 		 '{$_REQUEST['email']}',
						 		 '{$_REQUEST['url']}',
						 		 '{$_REQUEST['testo']}',
						 		 '".date("Y-m-d")."',
						 		 '{$_REQUEST['id']}')
					");
if ($oid) {
	$main->setContent("usercomments", getResult("SELECT nome,email,url,testo,data_commento FROM commento WHERE id_contenuto = ".$contenuto." ORDER BY id DESC, data_commento DESC"));
} else {
	$main->setContent("message", "Errore durante l'inserimento del commento.");
	$main->setContent("usercomments", getResult("SELECT nome,email,url,testo,data_commento FROM commento WHERE id_contenuto = ".$contenuto." ORDER BY id DESC, data_commento DESC"));
}
$main->close();
?>