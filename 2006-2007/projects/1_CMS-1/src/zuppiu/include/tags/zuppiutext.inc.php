<?

Class zuppiutext {
	
	function article($name, $data, $pars) {
		$content = "";
		$count = 0;
		
		if(count($data) == 0) {
			return "Non sono presenti articoli.";
		}
		
		$content .= "<table class=\"contenuti\">";
		
		
		foreach ($data as $key => $value) {
			$content .= "<tr><td colspan=\"2\" class=\"titolo\"><a href=\"article.php?id={$value[id]}\">{$value['titolo']}</a></td></tr>\n";
			$content .= "<tr><td colspan=\"2\" class=\"testo\">{$value['testo']}</td></tr>\n";
			$content .= "<tr>
						<td class=\"didascalia\">{$value['ora_creazione']}&nbsp;{$value['data_creazione']}</td>
						<td class=\"commento\"><a href=\"article.php?id={$value['id']}#comments\">Lascia un commento</a></td>
						</tr>\n";
		}
		
		$content .= "</table>";
		
		return $content;
		
	}
	
	function comments($name, $data, $pars) {
		if(count($data) == 0) {
			return "Nessuno commento presente.";
		}
		
		$content = "<table align=\"center\" class=\"usercomment\">";
		
		foreach($data as $k => $value) {
			$content .= "<tr><th colspan=\"2\">{$value['nome']}</th></tr>";
			$content .= "<tr><td colspan=\"2\">{$value['testo']}</td></tr>";
			$content .= "<tr>
						 <td>
						 ".($value['url'] != '' ? '<a href="'.$value['url'].'" target="_blank">Sito Web</a>' : '')."
						 </td>
						 <td align=\"right\">Lasciato il: {$value['data_commento']}</td>
						 </tr>";
		}
		
		$content .= "</table>";
		
		return $content;
	}
	
	function filelist($name, $data, $pars) {
		$trovato = false;
		if(count($data) == 0) {
			return $content;
		}
		
		$content .= "<span class=\"filelist\">Files associati<br/>";
		$content .= "<ul>\n";
		foreach ($data as $key => $value) {
			$filename = explode(".",$value[$pars['text']]);
			if (($filename[sizeof($filename)-1] != "html") && ($filename[sizeof($filename)-1] != "htm")) {
				$content .= "<li><a target=\"_blank\" href=\"{$value[$pars['link']]}{$value[$pars['text']]}\">{$value[$pars['text']]}</a></li>";
			} else {
				$content .= "<li><a href=\"javascript:showHTMLFile('{$value[$pars['link']]}{$value[$pars['text']]}');\" title=\"Mostra file\">{$value[$pars['text']]}</a></li>";
				$trovato = true;
			}
			$number++;
		}
		
		$content .= "</ul></span>";
		$content .= ($trovato ? "\n<center><div style=\"width: 90%; text-align: left;\" id=\"htmlfile\"></div></center>" : "")."<br/>";
		return $content;
	}
	
}

?>