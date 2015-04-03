<?php
include "lib.php";
checkSessione();
$smarty = includeSmarty();
$smarty->assign("logged",true);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

?>
<?php
$id_utente = $_SESSION["id_utente"];
$id_prodotto = $_GET["id_prodotto"];

// Controlla autore prodotto
$sql = "SELECT * FROM prodotti WHERE id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
$result = mysql_query($sql);

if (checkServizio(7,$_SESSION["id_utente"]) || mysql_num_rows($result))
{
    $sql = "DELETE FROM prodotti WHERE id_prodotto=".$id_prodotto;
    mysql_query($sql) or die (mysql_error());
    $smarty->assign("id_prodotto",$id_prodotto);
}
else
{
    makePermissionError(7);
}
$smarty->display("del_prodotto.tpl.html");
?>
