<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";
require "include/menu.inc.php";

$main = new Template("dtml/article.html");
$navigate = new Template("dtml/navigate.html");
$qid = mysql_query("SELECT * FROM features");
$features = mysql_fetch_assoc($qid);
$main->setContent("servicetitle", $features['nomeservizio']);
$main->setContent("description", $features['descrizione']);
$leavecomments = new Template("dtml/leave_comments.html");
$leavecomments->setContent("id", $_REQUEST['id']);
$main->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY posizione"), "value=\"id\"" );
$main->setContent("link", getResult("SELECT nome,url FROM link ORDER BY nome"), "value=\"url\"" );
Menu::setMenu();
$main->setContent("navigate", $navigate->get() );
$main->setContent("contenuto", getResult("SELECT contenuto.id, contenuto.titolo, contenuto.testo, contenuto.data_creazione, contenuto.ora_creazione
										  FROM contenuto
										  WHERE pubblicato = 'Y'
										  AND contenuto.id = '{$_REQUEST['id']}'
										  ORDER BY contenuto.data_creazione DESC , contenuto.ora_creazione DESC") );
$main->setContent("leavecomments", $leavecomments->get());
$main->setContent("files", getResult("SELECT file.path, file.nome, file.size
									  FROM file,contenuto_file
									  WHERE file.nome = contenuto_file.filename
									  AND contenuto_file.id_contenuto = '{$_REQUEST['id']}'"), "text=\"nome\" link=\"path\"");
$main->setContent("commenti", getResult("SELECT nome,email,url,testo,data_commento FROM commento WHERE id_contenuto = {$_REQUEST['id']} ORDER BY id DESC, data_commento DESC"));
$main->close();
?>