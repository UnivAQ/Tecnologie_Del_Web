<?php
include "lib.php";
$sql = "SELECT categorie.id_categoria as id_categoria, categorie.nome as nome_categoria FROM macrocategorie, cat_macrocat, categorie WHERE macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND cat_macrocat.id_categoria=categorie.id_categoria AND macrocategorie.id_macrocategoria=".$_GET["id_macrocategoria"];
$query = mysql_query($sql) or die(mysql_error());
echo "<select name=\"id_categoria\">";
while($resrow = mysql_fetch_object($query))
{
    echo "<option value=$resrow->id_categoria>$resrow->nome_categoria</option>";
}
echo "</select>";

?>
