<?
#
# form.inc.php
#
# *************************************
#
# Tag Library - Class form


Class form {

	/**
	@param $name Valore dell'attributo name del widget
	@param $data Dati che la funzione deve formattare
	@param $pars Variabili (opzionali) aggiuntive per la corretta formattazione
	*/
	
	function categorylist($name, $data, $pars) {
		
		$content = "";
		
		$fields = explode(" ",$pars['text']);
		
		foreach ($data as $key => $value) {
			
			$content .= "\t<a href=\"{$pars['page']}.php?";
			$content .= "id={$value[$fields[0]]}\">{$value[$fields[1]]}</a><br />\n";
			
		}
		
		return $content;
	}
	
	function linklist($name, $data, $pars) {
		
		$content = "";
		
		$fields = explode(" ",$pars['text']);
		
		foreach ($data as $key => $value) {
			
			$content .= "\t&nbsp;<a href=\"{$value[$pars[hurl]]}\" title=\"{$value[$pars[title]]}\">";
			
			foreach ($fields as $k => $v) {
				$content .= "{$value[$v]}";
			}
			
			$content .= "</a><br />\n";
			
		}
		
		return $content;
	}

	function testo($name, $data, $pars) {
		
		$content = "";
		
		$fields = explode(" ", $pars['text']);
		
		if($data) {
			foreach($data as $key => $value) {
					$content .= "<div id=\"titolo\">{$value[$fields[0]]}</div>\n";
					$content .= "<div id=\"articolo\">{$value[$fields[1]]}</div>\n";
			}
		}
		
		return $content;
	}
	
	
  function radio($name, $data, $pars) {
	
  	$fields = explode(" ", $pars['text']);
  	
  	foreach($data as $k => $v) {
  		$content .= "\t<input type=\"radio\" value=\"{$v[$pars[value]]}\">";
  		foreach($fields as $key => $value) {
  			$content .= " {$v[$value]}<br />\n";
  		}
  	}
  	
  	return $content;
  }	
  
  function check($name, $data, $pars) {
	
  	$fields = explode(" ", $pars['text']);
  	
  	foreach($data as $k => $v) {
  		$content .= "\t<input type=\"checkbox\" name=\"{$name}[]\" value=\"{$v[$pars[value]]}\">";
  		foreach($fields as $key => $value) {
  			$content .= " {$v[$value]}<br />\n";
  		}
  	}
  	
  	return $content;
  }	
  
  function select($name, $data, $pars) {
  	
  	$fields = explode(" ", $pars['text']);
  	
  	$content = "\t<select name=\"{$name}\">\n";
  	
  	if ($pars['header']) {
  		$content .= "\t\t<option value=\"\">{$pars['header']}</option>\n";
  	}
  	
  	foreach($data as $k => $v) {
  		
  		$content .= "\t\t<option value=\"{$v[$pars[value]]}\">";
  		
  		foreach ($fields as $key => $value) {
  			$content .= "{$v[$value]} ";
  		}
  		
  		$content .= "</option>\n";
  		
  	}
  	
  	$content .= "</select>";
  	
  	return $content;
  	
  }
	
}