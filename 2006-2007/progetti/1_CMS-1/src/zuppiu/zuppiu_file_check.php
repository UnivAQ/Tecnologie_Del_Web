<?

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_simple_response.html");
$oid = mysql_query("SELECT * FROM file WHERE nome = '".addslashes($_REQUEST['filename'])."'");
if(mysql_num_rows($oid) == 0) {
	$main->setContent("message", "ok");
} else {
	$main->setContent("message", "ko");
}
$main->close();

?>