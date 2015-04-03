<?php
include "lib.php";
checkSessione();
$smarty = includeSmarty();
$smarty->assign("logged",true);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

if (!checkServizio(5,$_SESSION["id_utente"]))
{
    makePermissionError(5);
}
?>
<?php
$id_utente = $_SESSION["id_utente"];
$id_feedback = intval($_GET["id_feedback"]);

if ($_GET["rating"] == "plus")
    $rating = 1;
else 
	if ($_GET["rating"] == "minus")
		$rating= -1;

if (isset($rating))
{	
	$sql = "SELECT COUNT(*) as numero_rating FROM rating_feedback WHERE id_feedback=".$id_feedback." AND id_utente=".$id_utente;
	$result = mysql_query($sql);
	$resrow = mysql_fetch_object($result);
	if ($resrow->numero_rating==0)
	{
		$sql = "INSERT INTO rating_feedback (id_rating_feedback, id_feedback, id_utente, rating) VALUES (NULL,$id_feedback,$id_utente,$rating)";
	    mysql_query($sql) or die (mysql_error());
	}
}

$smarty->display("add_rating_feedback.tpl.html");
//header("location: prodotto.php?id_prodotto=".$_GET['id_prodotto']."");
include "db_close.php";
?>
