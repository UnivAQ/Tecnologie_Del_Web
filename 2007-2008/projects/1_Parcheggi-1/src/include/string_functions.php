<?php

function string_clean($string) {
        $string = trim($string);
        $string = strip_tags($string, "<img><b><i><a>");
        if ( get_magic_quotes_gpc() ) {
        	return $string;
        }
        else {
        	return addslashes($string);
        }
}


function string_soil($string) {
        return stripslashes($string);
}

?>
