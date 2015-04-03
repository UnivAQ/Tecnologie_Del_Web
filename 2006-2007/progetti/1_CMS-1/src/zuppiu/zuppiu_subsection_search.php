<?

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_widget_response.html");

$main->setContent("results", getResult("SELECT id, nome
										  FROM sottosezione
                                         WHERE id_sezione = '{$_REQUEST['idsection']}'"));
$main->close();

?>