<?

function getResult($query) {
	$oid = mysql_query($query) or die("Error: ".mysql_errno()." - ".mysql_error());
	
	do {
		$data = mysql_fetch_assoc($oid);
		if ($data) {
			$result[] = $data;
		}
	} while ($data);
	
	return $result;
}

function getFirstResults($query, $max) {
	$oid = mysql_query($query) or die("Error: ".mysql_errno()." - ".mysql_error());
	$counter = 0;
	do {
		$data = mysql_fetch_assoc($oid);
		if ($data) {
			$result[] = $data;
		}
		$counter++;
	} while ($data && $counter < $max);
	
	return $result;
}

function getCountResult($query) {
	$oid = mysql_query($query) or die("Error: ".mysql_errno()." - ".mysql_error());
	return mysql_num_rows($oid);
}

function is_uploadable_file($filetype) {
	if ($filetype == "application/msexcel" ||
		$filetype == "application/msword" ||
		$filetype == "application/pdf" ||
		$filetype == "application/postscript" ||
		$filetype == "application/rtf" ||
		$filetype == "application/x-zip-compressed" ||
		$filetype == "image/jpeg" ||
		$filetype == "image/bmp" ||
		$filetype == "image/png" ||
		$filetype == "text/html" ||
		$filetype == "text/plain") {
			return true;
		}
	return false;
}

function spacize($array) {
		$first = true;
		$content = "";
		
		foreach($array as $key => $value) {
			foreach($value as $element) {
				if ($first) {
					$content .= "$element";
					$first = false;
				} else {
					$content .= " $element";
				}
			}
		}
		
		return $content;
}

function extract_html($filename) {
	
	$html = new Template($filename);
	if (ereg("<body>(.*)</body>", $html->get(), $tokens)) {
		$content = ereg_replace("<script(.*)</script>","",$tokens[1]);
		$content = ereg_replace("(\n){2,}","", $content);
		$content = ereg_replace("<object(.*)</object>","", $content);
		$content = ereg_replace("<iframe(.*)</iframe>","", $content);
		$content = ereg_replace("<img(.*)>","", $content);
		return $content;
	}
	
	return "File non accettato.";
}
?>