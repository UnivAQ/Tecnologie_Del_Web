<?

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_group_response.html");

$oid = mysql_query("INSERT INTO gruppo VALUES (NULL, '{$_REQUEST['nome']}')");
$main->setContent("results", getResult("SELECT id,nome FROM gruppo ORDER BY nome"));
$main->close();

?>