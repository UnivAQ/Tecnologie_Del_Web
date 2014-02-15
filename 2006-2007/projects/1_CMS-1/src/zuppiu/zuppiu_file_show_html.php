<?

require "include/template.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_simple_response.html");
$main->setContent("message", extract_html($_REQUEST['nome']));
$main->close();

?>