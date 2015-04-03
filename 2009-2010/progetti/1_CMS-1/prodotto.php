<?php
include "lib.php";
$smarty = includeSmarty();
	session_start();
	session_regenerate_id(TRUE);

if (isset($_SESSION['username']) && isset($_SESSION['password'] ) )
{
    $logged=true;
    $id_utente = $_SESSION["id_utente"];
    $smarty->assign("username",$_SESSION["username"]);
}
else
{
    $logged=false;
    $id_utente = -1;
}

$smarty->assign("logged",$logged);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

//if (!checkServizio(1,$id_utente))
//{
//    makePermissionError(1);
//}
?>
<?php 

// Eventuale controllo esistenza
$id_prodotto = $_GET["id_prodotto"];

// Seleziona dati oggetto
$sql = "SELECT * FROM prodotti where id_prodotto=".$id_prodotto;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
$titolo = $resrow->titolo;
$descrizione = nl2br(htmlspecialchars($resrow->descrizione));
$id_categoria = $resrow->id_categoria;

// Seleziona categorie oggetto
$sql = "SELECT categorie.nome AS nome_categoria, macrocategorie.nome AS nome_macrocategoria, macrocategorie.id_macrocategoria FROM categorie,macrocategorie,cat_macrocat WHERE categorie.id_categoria=cat_macrocat.id_categoria AND macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND categorie.id_categoria=".$id_categoria;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
$nome_macrocategoria = $resrow->nome_macrocategoria;
$id_macrocategoria = $resrow->id_macrocategoria;
$nome_categoria = $resrow->nome_categoria;


// Seleziona rating oggetto
$sql = "SELECT COUNT(*) AS numero_rating, SUM(rating) AS somma_rating FROM rating where id_prodotto=".$id_prodotto;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
$numero_rating = $resrow->numero_rating ? $resrow->numero_rating : 1;
$somma_rating = $resrow->somma_rating;
$rating_medio = number_format(($somma_rating/$numero_rating),1);

$prodotto = array('id_prodotto'=>$id_prodotto, 'titolo'=>$titolo, 'descrizione'=>$descrizione,'id_macrocategoria'=>$id_macrocategoria, 'id_categoria'=>$id_categoria, 'nome_macrocategoria'=>$nome_macrocategoria, 'nome_categoria'=>$nome_categoria, 'rating_medio'=>$rating_medio);

if (checkServizio(3,$id_utente) && $logged)
{
	$sql = "SELECT COUNT(*) AS numero_rating FROM rating where id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
	$result = mysql_query($sql);
	$resrow = mysql_fetch_object($result);
	if ($resrow->numero_rating==0)
            $smarty->assign("can_rate",true);
}

// Feedback utenti + rating feedback
$sql = "SELECT *, feedback.titolo as titolo FROM feedback,utenti,prodotti WHERE feedback.id_utente=utenti.id_utente AND feedback.id_prodotto=prodotti.id_prodotto AND feedback.id_prodotto=".$id_prodotto;
$result = mysql_query($sql);
if (mysql_num_rows($result)!=0)
{
    $i=0;
    while ($resrow = mysql_fetch_object($result))
    {
        $feedback[$i]=array('titolo'=>$resrow->titolo, 'username'=>$resrow->username, 'feedback'=>nl2br(htmlspecialchars($resrow->feedback)), 'id_feedback'=>$resrow->id_feedback);

        // Rating feedback
        $sql2 = "SELECT SUM(rating) as somma_rating FROM rating_feedback WHERE id_feedback=".$resrow->id_feedback;
        $result2 = mysql_query($sql2);
        $resrow2 = mysql_fetch_object($result2);
        $somma_rating = $resrow2->somma_rating ? $resrow2->somma_rating : 0;

        $feedback[$i]=array_push_assoc($feedback[$i], 'somma_rating', $somma_rating);
        
        if (checkServizio(5,$id_utente) && $logged)
        {
            // Controllo possibilità rating
            $sql2 = "SELECT COUNT(*) as numero_rating FROM rating_feedback WHERE id_feedback=".$resrow->id_feedback." AND id_utente=".$id_utente;
            $result2 = mysql_query($sql2);
            $resrow2 = mysql_fetch_object($result2);
            if ($resrow2->numero_rating==0)
                $feedback[$i]=array_push_assoc($feedback[$i], 'can_rate', true);

            // Controllo delete
            $sql2 = "SELECT * FROM feedback WHERE id_feedback=".$resrow->id_feedback." AND id_utente=".$id_utente;
            $result2 = mysql_query($sql2);
            if (checkServizio(7,$_SESSION["id_utente"]) || mysql_num_rows($result2))
                $feedback[$i]=array_push_assoc($feedback[$i], 'can_delete', true);

            
        }
        $i++;
    }
}
$smarty->assign("feed",$feedback);
// Inserimento Feedback
if (checkServizio(4,$id_utente) && $logged)
{
	$sql = "SELECT COUNT(*) AS numero_feedback FROM feedback where id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
	$result = mysql_query($sql);
	$resrow = mysql_fetch_object($result);
	if ($resrow->numero_feedback==0)
            $prodotto=array_push_assoc($prodotto, 'can_add_feedback', true);
}

// SPECIFICHE
$sql = "SELECT * FROM specifiche WHERE id_prodotto=".$id_prodotto;
$result = mysql_query($sql);
if (mysql_num_rows($result)!=0)
    while ($resrow = mysql_fetch_object($result))
        $specifiche[] = array('denominazione'=>$resrow->denominazione, 'valore'=>$resrow->valore);
$smarty->assign("spec",$specifiche);


// Eliminazione prodotto
$sql = "SELECT * FROM prodotti WHERE id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
$result = mysql_query($sql);
if (checkServizio(8,$id_utente) || mysql_num_rows($result))
    $prodotto=array_push_assoc($prodotto, 'can_delete', true);

// Controlla autore prodotto
$sql = "SELECT * FROM prodotti WHERE id_prodotto=".$id_prodotto." AND id_utente=".$id_utente;
$result = mysql_query($sql);

// Controlla se ha la possibilità di modificare oggetti o l'oggetto è suo
if (checkServizio(6,$id_utente) || mysql_num_rows($result))
    $prodotto=array_push_assoc($prodotto, 'can_edit', true);

// Controlla se ha la possibilità di aggiungere specifiche
if (checkServizio(2,$id_utente))
    $prodotto=array_push_assoc($prodotto, 'can_add_specifiche', true);

$smarty->assign("prodotto",$prodotto);
$smarty->display("prodotto.tpl.html");
include "db_close.php";
?>