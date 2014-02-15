<?php
include "lib.php";
checkSessione();

if (!checkServizio(3,$_SESSION["id_utente"]))
{
    makePermissionError(3);
}
?>
<?php
$id_utente = $_SESSION["id_utente"];
$id_prodotto = intval($_POST["id_prodotto"]);
$rating = intval($_POST["rating"]);

$sql = "SELECT COUNT(*) AS numero_rating FROM rating where id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
if ($resrow->numero_rating==0)
{
    $sql = "INSERT INTO rating (id_rating, id_prodotto, id_utente, rating) VALUES (NULL,$id_prodotto,$id_utente,$rating)";
    $result = @mysql_query ($sql) or die (mysql_error());
}
header("location: prodotto.php?id_prodotto=".$id_prodotto."");

include "db_close.php";
?>