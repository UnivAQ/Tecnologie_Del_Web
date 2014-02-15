<?

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_rich_response.html");

$query = ($_REQUEST['filetype'] != "tutti" ? "SELECT nome,size,username
					  FROM file
					 WHERE nome LIKE '%{$_REQUEST['filename']}%'
					   AND mimetype = '{$_REQUEST['filetype']}'
				  ORDER BY size
					 " : "SELECT nome,size,username
					  FROM file
					 WHERE nome LIKE '%{$_REQUEST['filename']}%'
				  ORDER BY size
					 ");

$main->setContent("results", getResult($query));
$main->close();

?>