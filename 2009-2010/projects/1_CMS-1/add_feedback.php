<?php
include "lib.php";
checkSessione();

if (!checkServizio(4,$_SESSION["id_utente"]))
{
    makePermissionError(4);
}
?>
<?php
$id_utente = $_SESSION["id_utente"];
$id_prodotto = intval($_POST["id_prodotto"]);
$titolo = htmlspecialchars($_POST["titolo"]);
$feedback = htmlspecialchars($_POST["feedback"]);


$sql = "SELECT COUNT(*) AS numero_rating FROM feedback where id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
if ($resrow->numero_rating==0)
{
    $sql = "INSERT INTO feedback (id_feedback, id_prodotto, id_utente, titolo, feedback) VALUES (NULL,$id_prodotto,$id_utente,'$titolo','$feedback')";
    $result = @mysql_query ($sql) or die (mysql_error());
}
header("location: prodotto.php?id_prodotto=".$id_prodotto."");

include "db_close.php";
?>