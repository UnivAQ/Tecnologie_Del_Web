<?php
include "lib.php";
checkSessione();
?>
<?php
$id_utente = $_SESSION["id_utente"];
$id_feedback = $_GET["id_feedback"];
$id_prodotto = $_GET["id_prodotto"];

// Controlla autore prodotto
$sql = "SELECT * FROM feedback WHERE id_feedback=".$id_feedback." AND id_utente=".$id_utente;
$result = mysql_query($sql);

if (checkServizio(8,$_SESSION["id_utente"]) || mysql_num_rows($result))
{
    $sql = "DELETE FROM feedback WHERE id_feedback=".$id_feedback;
    mysql_query($sql) or die (mysql_error());
    header("location: prodotto.php?id_prodotto=".$id_prodotto);
}
else
{
    makePermissionError(8);
}

?>
