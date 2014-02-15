<?php
include "lib.php";
checkSessione();
$smarty = includeSmarty();
$smarty->assign("logged",true);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
{
    $smarty->assign("admin",true);
    $is_admin=true;
}

if (!checkServizio(2,$_SESSION["id_utente"]) && !$is_admin)
{
    makePermissionError(2);
}
?>
<?php
$id_utente = $_SESSION["id_utente"];
$id_prodotto = $_GET["id_prodotto"];

// Controllo sicurezza
$sql = "SELECT * FROM prodotti WHERE prodotti.id_prodotto=".$id_prodotto." AND prodotti.id_utente=".$id_utente;
$result = mysql_query($sql);
if (!mysql_num_rows($result) && !is_admin)
    makePermissionError(-1);

if (isset ($_POST["save"]))
{
    $n = count($_POST['denominazione']);
    for ($i=0; $i<$n; $i++)
    {
        if ($_POST['denominazione'][$i]!="" && $_POST['valore'][$i]!="")
        {
        $sql = "INSERT INTO specifiche (id_specifica, id_prodotto, denominazione, valore) VALUES (NULL, $id_prodotto, '".$_POST['denominazione'][$i]."', '".$_POST['valore'][$i]."')";
        mysql_query($sql) or die (mysql_error());
        }
    }

}

if (isset($_GET["delete"]) && isset($_GET["id_specifica"]))
{
    $sql = "DELETE FROM specifiche WHERE id_specifica=".$_GET["id_specifica"];
    mysql_query($sql) or die (mysql_error());
}

$smarty->assign("id_prodotto",$id_prodotto);

$sql = "SELECT id_specifica, denominazione,valore FROM specifiche WHERE id_prodotto=".$id_prodotto;
$result = mysql_query($sql);
if (mysql_num_rows($result))
{
    while ($resrow = mysql_fetch_object($result))
        $specifiche[]=array('denominazione'=>$resrow->denominazione, 'valore'=>$resrow->valore, 'id_specifica'=>$resrow->id_specifica);

}

$smarty->assign("id",$id_prodotto);
$smarty->assign("spec",$specifiche);
$smarty->display("add_specifiche.tpl.html");
include "db_close.php";
?>