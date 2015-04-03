<?
include "config.inc.php";
if (isset($_GET['id']))
{
    $id = intval($_GET['id']);
    $sql = "SELECT tipo_img,immagine FROM prodotti WHERE id_prodotto='$id'";
    $result = mysql_query($sql) or die(mysql_error ());

    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_array($result);
        $type = $row['tipo_img'];
        $img = $row['immagine'];
        if ($type!="")
        {
            header ("Content-type: ".$type);
            echo $img;
        }

    }
}
header ("location: file/noimg.jpg");

?>