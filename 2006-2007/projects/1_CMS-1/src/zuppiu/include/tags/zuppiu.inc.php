<?
Class zuppiu {

	function menu($name, $data, $pars) {
		$content = "<table class=\"sidemenu\">\n";
		$content .= "<caption>".ucfirst($name)."</caption>";
		foreach ($data as $k=>$value) {
			$content .= "\t<tr onMouseOver=\"zover(this);\" onMouseOut=\"zout(this);\">\n";
			
			foreach($value as $key => $element) {
				if ($pars['value'] == "id" && $key != $pars['value']) {
					$content .= "<td onclick=\"redir('".($pars['type'] == "link" ? 'http://' : '')."{$pars['action']}.php?id={$value[$pars['value']]}');\">$element </td>\n";
				} else if ($key != $pars['value']) {
					$content .= "<td onclick=\"redir('".($pars['type'] == "link" ? 'http://' : '')."{$value[$pars['value']]}');\">$element </td>\n";
				}
			}

			$content .= "</tr>\n";
		}
		
		$content .= "</table>\n";
		
		return $content;
	}
	
	function stringsequence($name, $data, $pars) {
		$content = "";
		foreach ($data as $key => $value) {
			foreach ($value as $element) {
				$content .= "$element ";
			}
		}
		return substr($content, 0, -1);
	}
	
	function mex($name, $data, $pars) {
		$content = "";
		$content .= "<div id=\"message_{$pars['esito']}\">$data</div>";
		return $content;
	}
	
	function report($name, $data, $pars) {
		
		if(count($data) == 0) {
			$content = "<div id=\"message_ko\">&nbsp;&nbsp;Non sono stati inseriti elementi.</div>";
			return $content;
		}
		
		$content = "<table class=\"report\">";
		$first = true;
		$content .= "<tr>";
		foreach($data as $chiave => $valore) {
			if ($first) {
				foreach ($valore as $colonna => $val)
					$content .= "<td class=\"report_title\">".ucwords(ereg_replace("_"," ",$colonna))."</td>";
				}
			$first = false;
		}
		$content .= "<td colspan=\"3\" class=\"report_title\">Operazioni</td>";
		$content .= "</tr>";
		
		foreach($data as $key => $value) {
			$content .= "<tr onmouseover=\"zover(this);\" onmouseout=\"zout(this);\">\n";
				
			foreach($value as $k => $element) {
				if (strlen($element) < 101) {
					$content .= "<td class=\"inner\">$element</td>";
				} else {
					$content .= "<td class=\"inner\">".substr($element,0,100)."...</td>";
				}
			}
			
			$chiave = ereg_replace("_","",$pars[keyName]);
			$data[key][$pars[keyName]] = addslashes($data[key][$pars[keyName]]);
			
			if ($pars[view]) {
				$content .= "<td align=\"center\"><span class=\"task\" onclick=\"redir('{$pars[view]}?{$chiave}=".addslashes($data[$key][$pars[keyName]])."', {$pars[target]});\">Visualizza</span></td>";
			}
			
			if ($pars[edit]) {
				$content .= "<td align=\"center\"><span class=\"task\" onclick=\"redir('{$pars[edit]}?{$chiave}=".addslashes($data[$key][$pars[keyName]])."', {$pars[target]});\">Modifica</span></td>";
			}
			
			if ($pars[delete]) {
				$content .= "<td align=\"center\"><span class=\"task\" onclick=\"deleteConfirm('{$pars[delete]}?{$chiave}=".addslashes($data[$key][$pars[keyName]])."&ref={$pars[referer]}');\">Cancella</span></td>";
			}
				
			$content .= "</tr>";
			
		}
		
		$content .= "</table>";
		
		return $content;
		
	}
	
	function enum($name, $data, $pars) {
		if(count($data) == 0) {
			return ucfirst($name);
		} else {
			return "<a href=\"zuppiu_report.php?id={$pars[report]}\">".ucfirst($name)."</a> (".count($data).")";
		}
	}
	
	function select($name, $data, $pars) {
		if($pars[size]) {
			$content = "<select name=\"{$name}\" size=\"{$pars[size]}\">";
		} else {
			$content = "<select name=\"{$name}\">";
		}
		
		if($pars[header]) {
			$content .= "<option value=\"\">{$pars[header]}</option>\n";
		} else {
			$content .= "<option value=\"\">Seleziona...</option>\n";
		}
		
		foreach ($data as $key => $value) {
			if ($value[$pars[param]] == $pars[selected]) {
				$content .= "<option value=\"{$value[$pars[value]]}\" selected=\"selected\">";
			} else {
				$content .= "<option value=\"{$value[$pars[value]]}\">";
			}
			
			
			foreach ($value as $k => $element) {
				if ($k != $pars[value]) {
					$content .= "$element ";
				}
			}
			$content .= "</option>";
		}
		
		$content .= "</select>";
		
		return $content;
		
	}
	
	function positionChanger($name, $data, $pars) {
		if($pars[size]) {
			$content = "<select name=\"{$name}\" size=\"{$pars[size]}\">";
		} else {
			$content = "<select name=\"{$name}\">";
		}
		
		foreach ($data as $key => $value) {
			$content .= "<option value=\"{$value[$pars[value]]}\">";
			foreach ($value as $k => $element) {
				if ($k != $pars[value]) {
					$content .= "$element ";
				}
			}
			$content .= "</option>";
		}
		$content .= "<option value=\"0\">&lt; NUOVO &gt;</option>";
		$content .= "</select><br/>";
		$content .= "<button type=\"button\" class=\"other\" onclick=\"positionUp();\"><img border=\"0\" src=\"img/arrow_up.gif\" alt=\"SU\" /></button> ";
		$content .= "<button type=\"button\" class=\"other\" onclick=\"positionDown();\"><img border=\"0\" src=\"img/arrow_down.gif\" alt=\"GIU'\"></button>";
		
		return $content;
	}
	
	function elenco($name, $data, $pars) {
	
  	$fields = explode(" ", $pars['text']);  	
  	
  	foreach($data as $k => $v) {
  		$content .= "\t<img border=\"0\" src=\"img/arrow.gif\" /> <span class=\"sections\" onClick=\"showSubsections({$v[$pars[value]]},'{$v[$pars[text]]}');\">";
  		foreach($fields as $key => $value) {
  			$content .= " {$v[$value]}</span><br/>\n";
  		    $content .= "<div class=\"smaller\" id=\"{$v[$value]}\"></div>";
  		}
  	}
  	
  	return $content;
  	
	}
	
	function subcheck($name, $data, $pars) {
	$i = 0;
  	$fields = explode(" ", $pars['text']);
  	
  	if($pars['sel'] != "") {
  		$selected = explode(" ", $pars['sel']);
  	}
  	
  	if(count($data) == 0) {
  		return "Nessuna sottosezione.";
  	}
  	
  	foreach($data as $k => $v) {
  		
  		if ($pars['sel']) {
  			$trovato = false;
  			while (($i < sizeof($selected)) && ($trovato == false)) {
				if ($v[$pars[value]] == $selected[$i]) {
					$trovato = true;
				}
				$i++;
  			}
  			if ($trovato) {
  				$content .= "\t<input type=\"checkbox\" name=\"{$name}_{$v[$pars[value]]}\" value=\"{$v[$pars[value]]}\" checked>";
  			} else {
  				$content .= "\t<input type=\"checkbox\" name=\"{$name}_{$v[$pars[value]]}\" value=\"{$v[$pars[value]]}\">";
  			}
  			$i = 0;
		} else {
			$content .= "\t<input type=\"checkbox\" name=\"{$name}_{$v[$pars[value]]}\" value=\"{$v[$pars[value]]}\">";
		}
		
  		foreach($fields as $key => $value) {
  			$content .= "<span> {$v[$value]}</span><br/>\n";
  		}
  	}
  	
  	return $content;
  	
	}
	
	function filesearch($name, $data, $pars) {
		$content = "";
		if(count($data)==0) {
			return "Nessuno file trovato.";
		}
		
		$content .= "<br/>Risultati<table class=\"filesearch\">";
		
		$content .= "<tr>";
		$first = true;
		foreach ($data as $chiave => $valore) {
			if ($first) {
				foreach ($valore as $c => $v) {
					$content .= "<td class=\"title\">".ucfirst($c)."</td>";
				}
				$first = false;
			}
		}
		$content .= "</tr>";
		
		foreach ($data as $key => $value) {
			$content .= "<tr>";
			
			foreach ($value as $k => $e) {
				if($k == $pars[param]) {
					$content .= "<td class=\"under\" onmouseover=\"fover(this);\" onmouseout=\"fout(this);\" onclick=\"addFile('".addslashes($e)."');\" title=\"Clicca per aggiungere il file\">$e</td>";
				} else {
					$content .= "<td>$e</td>";
				}
			}
			
			$content .= "</tr>";
			
		}
		
		$content .= "</table>";
		
		return $content;
		
	}
	
	function table($name, $data, $pars) {
		$content = "<table class=\"filesearch\">";
		
		foreach ($data as $key => $value) {
			$content .= "<tr>\n";
			
			foreach ($value as $element) {
				$content .= "<td>$element</td>";
			}
			
			$content .= "</tr>";
		}
		
		$content .= "</table>";
		
		return $content;
	}
	
	function pipe($name, $data, $pars) {
		$first = true;
		
		foreach($data as $key => $value) {
			foreach($value as $element) {
				if ($first) {
					$content .= "$element";
					$first = false;
				} else {
					$content .= "|$element";
				}
			}
		}
		
		return $content;
	}
	
}

Class zuppiuauxiliar {
	
	function first_comma($id, $sep) {
		global $commas;
	
		if(!isset($commas[$id])) {
			$commas[$id] = true;
			return  "";
		} else {
			return $sep;
		}
	}
		
}

?>