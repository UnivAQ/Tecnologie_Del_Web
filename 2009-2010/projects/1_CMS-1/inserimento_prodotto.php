<?php
include "lib.php";
checkSessione();
$smarty = includeSmarty();
$smarty->assign("logged",true);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

if (!checkServizio(2,$_SESSION["id_utente"]))
{
    makePermissionError(2);
}
?>
<?php 
if (isset($_POST['save']))
{
	if ($a=upload())
		header("location: prodotto.php?id_prodotto=".$a);
}

function upload()
{
    $tipo_img = $_FILES['file']['type'];
    $titolo = $_POST["titolo"];
    $descrizione = $_POST["descrizione"];
    $id_macrocategoria = $_POST["id_macrocategoria"];
    $id_categoria = $_POST["id_categoria"];
    $immagine = @file_get_contents($_FILES['file']['tmp_name']);
    $immagine = addslashes($immagine);

    $sql = "INSERT INTO prodotti (id_prodotto, id_categoria, id_utente, titolo, descrizione, tipo_img, immagine) VALUES (NULL,$id_categoria,".$_SESSION["id_utente"].",'".$titolo."','".$descrizione."','".$tipo_img."','".$immagine."')";
    $result = @mysql_query ($sql) or die (mysql_error());

    return mysql_insert_id();
}

$sql = "SELECT * FROM macrocategorie";
$result = mysql_query($sql);
while ($resrow = mysql_fetch_object($result))
       $macrocategorie[]=array('id_macrocategoria'=>$resrow->id_macrocategoria, 'nome_macrocategoria'=>$resrow->nome);

$smarty->assign("macrocategorie",$macrocategorie);
$smarty->display("inserimento_prodotto.tpl.html");
include "db_close.php";
?>

