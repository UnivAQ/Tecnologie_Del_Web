<?php
include "lib.php";
checkSessione();
$id_utente = $_SESSION["id_utente"];
$id_prodotto = $_GET["id_prodotto"];
$smarty = includeSmarty();
$smarty->assign("logged",true);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

// Controlla autore prodotto
$sql = "SELECT * FROM prodotti WHERE id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
$result = mysql_query($sql);

// Controlla se ha la possibilità di modificare oggetti o l'oggetto è suo
if (!checkServizio(6,$_SESSION["id_utente"]) && !mysql_num_rows($result))
{
    makePermissionError(6);
}
?>
<?
if (isset ($_POST["save"]))
{
    $titolo = $_POST["titolo"];
    $descrizione = $_POST["descrizione"];
    $id_macrocategoria = $_POST["id_macrocategoria"];
    $id_categoria = $_POST["id_categoria"];
    $tipo_img = $_FILES['file']['type'];
    $immagine = @file_get_contents($_FILES['file']['tmp_name']);
    $immagine = addslashes($immagine);

    // UPDATE PRODOTTO
    $sql = "UPDATE prodotti SET id_categoria=$id_categoria, titolo='".$titolo."', descrizione='".$descrizione."' WHERE id_prodotto=".$id_prodotto;
    $result = @mysql_query ($sql) or die ($sql.mysql_error());

    // UPDATE IMG
    if (is_uploaded_file($_FILES['file']['tmp_name']))
    {
        $sql = "UPDATE prodotti SET tipo_img='$tipo_img', immagine='$immagine' WHERE id_prodotto=".$id_prodotto;
        $result = @mysql_query ($sql) or die (mysql_error());
    }
header("location: prodotto.php?id_prodotto=".$id_prodotto);
}

// Selezione prodotto
$sql = "SELECT * FROM prodotti where id_prodotto=".$id_prodotto;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
$titolo = $resrow->titolo;
$descrizione = $resrow->descrizione;
$id_categoria = $resrow->id_categoria;

// Seleziona macrocategoria
$sql = "SELECT macrocategorie.id_macrocategoria AS id_macrocategoria, categorie.nome AS nome_categoria FROM macrocategorie,cat_macrocat,categorie WHERE macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND categorie.id_categoria=cat_macrocat.id_categoria AND cat_macrocat.id_categoria=".$id_categoria;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
$id_macrocategoria = $resrow->id_macrocategoria;
$nome_categoria = $resrow->nome_categoria;

$smarty->assign("prodotto",array('id_prodotto'=>$id_prodotto, 'titolo'=>$titolo, 'descrizione'=>$descrizione, 'id_macrocategoria'=>$id_macrocategoria, 'id_categoria'=>$id_categoria, 'nome_categoria'=>$nome_categoria));

$sql = "SELECT * FROM macrocategorie";
$result = mysql_query($sql);
while ($resrow = mysql_fetch_object($result))
       $macrocategorie[]=array('id_macrocategoria'=>$resrow->id_macrocategoria, 'nome_macrocategoria'=>$resrow->nome);

$smarty->assign("id",$id_prodotto);
$smarty->assign("macrocategorie",$macrocategorie);
$smarty->display("modifica.tpl.html");
?>