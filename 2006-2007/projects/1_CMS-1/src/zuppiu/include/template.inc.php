<?



function getDaySelect() {
    

  $data[0][value] = "";
  $data[0][text] = "";
  for($i=1;$i<=31;$i++) {

    if ($i < 10) {
      $dummy = "0$i";
    } else {
      $dummy = "$i";
    }

    $data[$i][value] = $dummy;
    $data[$i][text] = $dummy;
  }

  return $data;
}

function getMonthSelect() {
    
  $data[0][value] = "";
  $data[0][text] = "";

  for($i=1;$i<=12;$i++) {

    if ($i < 10) {
      $dummy = "0$i";
    } else {
      $dummy = "$i";
    }

    $data[$i][value] = $dummy;
    $data[$i][text] = $dummy;
  }

  return $data;
}



function query($query,$link = "") {
  global       
    $SCRIPT_FILENAME;

  $oid = mysql_query($query);

  if (!$oid) {
    $code = returnCode(error,generic,__FILE__,__LINE__);
  }

  do {
    $data = mysql_fetch_assoc($oid);
    if ($data) {
      $content[] = $data;
    }
  } while ($data);

  $script = basename($SCRIPT_FILENAME);
  if (($link != "") and (count($content) == 0)) {

    if (getType($link) == "integer") {
      Header("Location: $script?page=$link&code=$code");
    } else {
      Header("Location: $link&code=$code");
    }
  } else {
    return $content;
  }
}


Class Render {

  function ShowData($name,$data,$parameters,$value = "",$event = "") {
    
    $content .= "<table bgcolor=#eeeeee style='border: 2px solid salmon;'>";
    $content .= "<tr><td>Widget Name</td><td><b>$name</b></td></tr>\n";
    
    if ($parameters != "") {
          $content .= "<tr><td>Parameters</td><td>$parameters</td></tr>\n";
    }

    $content .= "<tr><td>Data count</td><td>".count($data)."</td></tr>\n";
    

    if (count($data)>0) {

      $content .= "<tr><td colspan=2><hr style='height: 1px; background: salmon; width: 98%;' ></td></tr>\n";


      foreach($data as $k => $v) {

	$content .= "<tr><td align=center>$k</td><td>";

	foreach($v as $k1 => $v1) {

	  $content .= "$k1: $v1<br>";
	}
	$content .="<hr style='height: 1px; background: salmon; width: 98%;'></td></tr>\n";

      }

    }
    

    
    $content .= "</table>";

    return $content;
  }

  function explodeParameters($parameters) {

    $buffer = $parameters;

    do {

      $result = ereg("^([[:alnum:]]+)",$buffer,$token);

      if ($result) {

	$buffer = ereg_replace("^$token[1]","",$buffer);

	$result2 = ereg("^=\"([[:alnum:] ]*)\"",$buffer,$token2);

	if ($result2) {

	  $buffer = ereg_replace("^=\"$token2[1]\"[[:space:] ]*","",$buffer);

	  $par[$token[1]] = $token2[1];

	}
      }

    } while ($result);

    return $par;
  }


  function Select($name,$data,$parameters = "",$value = "",$event = "") {

    /* 

       $data is formatted like this 

       $data[0][value] 
       $data[0][text]

    */

    $attributes = Render::explodeParameters($parameters);
    $event = $attrubutes[event];

    $content .= "<select name=\"$name\" $event class=dataentry>\n";

    if (count($data) == 0) {
      $content .= "<option value=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
    } else {

      if (isset($attributes[first])) {
	$content .= "<option value=\"\">$attributes[first]\n";
      }      
    }

    if (count($data) > 0) { 
      foreach($data as $k => $v) {
	
	if (($v[value] == $value) or ($v[value] == $attributes[value]) or ($v[checked]) or ($v[selected])) {
	  $content .= "<option value=\"$v[value]\" selected> $v[text]\n";
	} else {
	  $content .= "<option value=\"$v[value]\"> $v[text]\n";
	}
      }
    }

    $content .= "</select>\n";

    return $content;
  } 

  function CheckBoxList($name,$data) {

    /* 

       $data is formatted like this 

       $data[0][value] 
       $data[0][text]
       $data[0][checked]

    */

    $content .= "<table cellspacing=0 cellpadding=0 width=100%>\n";

    foreach($data as $k => $v) {

      if (($k % 2) == 0) {
	$content .= my_comma(checkboxlist,"</td></tr>")."<tr><td width=1%>\n";
      } else {
	$content .= "</td><td width=1%>\n";
      }

      if ($v[checked]) {
	$content .= "<input type=checkbox name=\"".$name."_$v[value]\" value=\"*\" checked></td><td width=49%>$v[text]\n";
      } else {
	$content .= "<input type=checkbox name=\"".$name."_$v[value]\" value=\"*\"></td><td width=49%>$v[text]\n";
      }
    }

#    echo count($data);

    $contemt .= "</td></tr>\n";
    $content .= "</table>\n";

    return $content;
  } 

  function RadioBox($name,$data) {

    /* 

       $data is formatted like this 

       $data[0][value] 
       $data[0][text]
       $data[0][checked]

    */

    $content .= "<table cellspacing=0 cellpadding=0 width=100%>\n";

    foreach($data as $k => $v) {

      if (($k % 2) == 0) {
	$content .= my_comma(checkboxlist,"</td></tr>")."<tr><td width=1%>\n";
      } else {
	$content .= "</td><td width=1%>\n";
      }

      if ($v[checked]) {
	$content .= "<input type=radio name=\"$name\" value=\"*\" checked></td><td width=49%>$v[text]\n";
      } else {
	$content .= "<input type=radio name=\"$name\" value=\"*\"></td><td width=49%>$v[text]\n";
      }
    }

#    echo count($data);

    $contemt .= "</td></tr>\n";
    $content .= "</table>\n";

    return $content;
  } 


  function HiddenList($name,$data) {

    /* 

       $data is formatted like this 

       $data[0][value] 
       $data[0][text]

    */

    $content = "<input type=hidden name=$name value=\"".addslashes(serialize($data))."\">";

    return $content;
  } 

  function Date($name,$mode = "",$today = "") {

    switch($mode) {
    case forward:
      $year_min = date(Y);
      $year_max = date(Y)+2;
      break;
    case backward:
      $year_min = date(Y)-20;
      $year_max = date(Y)+2;
      break;
    default:
      $year_min = date(Y)-20;
      $year_max = date(Y)+20;
      break;
    }
   
    if ($today == "") {
      $today = date(Ymd);
    }

    $content .= "<select name=$name"."_d class=dataentry>\n";
    $content .= "<option>\n";
    
    for ($i=1;$i<=31;$i++) {
      if ($i < 10) {
	$dummy = "0$i";
      } else {
	$dummy = "$i";
      }
      if (substr($today,6,2) == $dummy) {
	$content .= "<option value=$dummy selected>$dummy\n";
      } else {
	$content .= "<option value=$dummy>$dummy\n";
      }
    }
    $content .= "</select>\n";
    
    $content .= "<select name=$name"."_m class=dataentry>\n";
    $content .= "<option>\n";
    for ($i=1;$i<=12;$i++) {
      if ($i < 10) {
	$dummy = "0$i";
      } else {
	$dummy = "$i";
      }
      if (substr($today,4,2) == $dummy) {
	$content .= "<option value=$dummy selected>$dummy\n";
      } else {
	$content .= "<option value=$dummy>$dummy\n";
      }
    }
    $content .= "</select>\n";
    
    $content .= "<select name=$name"."_y class=dataentry>\n";
    $content .= "<option>\n";

    for ($i=$year_min;$i<=$year_max;$i++) {
      if (substr($today,0,4) == $i) {
	$content .= "<option value=$i selected>$i\n";
      } else {
	$content .= "<option value=$i>$i\n";
      }
    }
    $content .= "</select>\n";
    
    return $content;
 } 

  function getDate($name) {

    return $GLOBALS[$name."_y"].$GLOBALS[$name."_m"].$GLOBALS[$name."_d"];
  }

}





#ob_start(); 
#ob_implicit_flush(0); 

function CheckCanGzip(){ 
  global $HTTP_ACCEPT_ENCODING;    

  if (headers_sent() || 
      connection_aborted()){ 
    return 0; 
  } 

  if (ereg("x-gzip",$HTTP_ACCEPT_ENCODING) !== false) {
    return "x-gzip"; 
  }

  if (ereg("gzip",$HTTP_ACCEPT_ENCODING) !== false) {
    return "gzip";
  } 


  return 0; 
} 

/* $level = compression level 0-9, 0=none, 9=max */

function GzDocOut($level=9,$debug = 0){ 


  $ENCODING = CheckCanGzip(); 
    

  if ($ENCODING){

    $Contents = ob_get_contents(); 
    ob_end_clean();
      $s = "\n<!-- Koriandol compress module : $ENCODING (".strlen($Contents)."/".strlen(gzcompress($Contents,$level)).") -->\n";
      $Contents .= $s;

    header("Content-Encoding: $ENCODING");  	
    print "\x1f\x8b\x08\x00\x00\x00\x00\x00"; 
    $Size = strlen($Contents); 
    $Crc = crc32($Contents); 
    $Contents = gzcompress($Contents,$level); 
    $Contents = substr($Contents, 0, strlen($Contents) - 4); 
    print $Contents; 
    print pack('V',$Crc); 
    print pack('V',$Size); 
    exit; 
  }else{ 
    ob_end_flush(); 
    exit; 
  } 
} 

class Template {
  var 
    $template_file,
    $buffer,
    $foreach,
    $content,
    $pars,
    $debug,
    $parsed;


  function Template($filename,$debug = "") {
    $this->template_file = $filename;
    $this->debug = $debug;
    $this->parsed = false;
    $fp = fopen ($filename, "r");
    $this->buffer = fread($fp, filesize($filename));         
    fclose($fp);
    $i=0;
    do {
      $result = ereg("<\[foreach\]>(.+)<\[\/foreach\]>",$this->buffer,$token);
      if ($result) {
	$this->foreach[] = $token[1];
	$this->buffer = ereg_replace("<\[foreach\]>.+<\[\/foreach\]>","<[foreach$i]>",$this->buffer);
      } 
      $i++;
    } while ($result);
  }
  
  function setContent($name, $value, $pars = "") {
    $this->content[$name][] = $value;
    $this->pars[$name][] = $pars;


  }

 

  function pre($var) { 
    if ($this->debug == "DEBUG") {
      return "<!- begin:$var -->";
    }
  }
  
  function post($var) { 
    if ($this->debug == "DEBUG") {
      return "<!- end:$var -->";
    }
  }
  
  function parse() {
    
    $this->parsed = true;

    if ($this->debug == "DEBUG") {
      $pre = "<!- \$token[1] -->";
      $post = "<!- \$token[1] -->";
    }
    
    
    
    
    for($i=0;$i<count($this->foreach);$i++) {
    
      $result = ereg("<\[([a-zA-Z0-9_]+)\]>",$this->foreach[$i],$token);
      if ($result) {
          $iterations = count($this->content[$token[1]]);
      }    
      
      for ($j=0;$j<$iterations;$j++) {
          $buffer = $this->foreach[$i];
          do {
              
              $result = ereg("<\[([a-zA-Z0-9_]+)\]>",$buffer,$token);
              if ($result) {
                  
                  $buffer = ereg_replace("<\[$token[1]\]>",$this->pre($token[1]).$this->content[$token[1]][$j].$this->post($token[1]),$buffer);
                  
                  
              
              }
              
              /* nuovo */
              $result_2 = ereg("<\[([a-zA-Z0-9_]+)::([a-zA-Z0-9_]+)[[:space:] ]*([[:alnum:] =\.\%\#\'\"\_-]*)\]>",$buffer,$token);
              if ($result_2) { 
                  
          
                  
                  $buffer = ereg_replace("<\[$token[1]::$token[2][[:space:] ]*$token[3]\]>",
				     $this->pre($token[1]).
				     $this->render($token[1],
						   $this->content[$token[1]][$j],
						   $token[2],
						   $token[3]).
				     $this->post($token[1]),
				     $buffer);
              }
              /* nuovo */
              
          } while ($result or $result_2);
          $this->content["foreach$i"][0] .= $buffer;
      }
    }         
    
    do {
        $result = ereg("<\[([a-zA-Z0-9_]+)\]>",$this->buffer,$token);
        if ($result) {
            $this->buffer = ereg_replace("<\[$token[1]\]>",$this->pre($token[1]).$this->content[$token[1]][0].$this->post($token[1]),$this->buffer);
        }
    } while ($result);


    do {
      $result = ereg("<\[([a-zA-Z0-9_]+)::([a-zA-Z0-9_]+)[[:space:] ]*([[:alnum:] =\.\%\#\'\"\_\-]*)\]>",$this->buffer,$token);
      if ($result) {
          $this->buffer = ereg_replace("<\[$token[1]::$token[2][[:space:] ]*$token[3]\]>",
				     $this->pre($token[1]).
				     $this->render($token[1],
						   $this->content["$token[1]"][0],
						   $token[2],
						   $token[3]).
				     $this->post($token[1]),
				     $this->buffer);

      }
    } while ($result);

  }
  
  function close() {

    if (!$this->parsed) {
      $this->parse();
    }

    echo $this->buffer;
#    gzdocout();
  }
  
  function get() {

    if (!$this->parsed) {
      $this->parse();
    }

    return $this->buffer;
  }

  function render($name,$data,$widget,$parameters,$value = "",$event = "") {

    $parameters = $parameters." ".$this->pars[$name][0];

    switch($widget) {
    case "select2":
    case "Select2":

    /* 

       $data is formatted like this 

       $data[0][value] 
       $data[0][text]

    */

      $content = Render::Select($name,$data,$parameters,$value,$event);
      break;
    case "checkbox":
    case "CheckBox":
    case "checkBox":
      $content = Render::CheckBoxList($name,$data,$value,$event);
      break;      
    case "radiobox":
    case "RadioBox":
    case "radioBox":
      $content = Render::RadioBox($name,$data,$value,$event);
      break;      

    case "show_data":
    case "showdata":
    case "showData":
    case "Showdata":
    case "ShowData":
    case "inspect":
    case "Inspect":

      $content = Render::ShowData($name,$data,$parameters,$value,$event);
      break;

    default:
      
      $pars = TagAux::parsePars($parameters);

      if ($pars[library]) {
	$library = $pars[library];
	require_once "include/tags/$library.inc.php";

      } else {
	$library = "TagLibrary";
      }

      echo $this->parameters[$widget][0];

      eval("\$content = ".$library."::".$widget."(\$name,\$data,TagAux::parsePars(\$parameters));");

      break;

    }
    return $content;
  }
}

Class TagAux {

 function parsePars($parameters) {
    
    $buffer = $parameters;
    do {
      $result = ereg("^([[:alnum:] \_]+)",$buffer,$token);
      if ($result) {
	$buffer = ereg_replace("^$token[1]","",$buffer);
	$result2 = ereg("^=\"([[:alnum:]\.\-\_\%\# \_\-]*)\"",$buffer,$token2);
	if ($result2) {
	  $buffer = ereg_replace("^=\"$token2[1]\"[[:space:] ]*","",$buffer);
	  $par[$token[1]] = $token2[1];
       }
      }
      
    } while ($result);

    return $par;
  }


}

Class TagLibrary {

  function htmlInclude($nome,$data,$pars) {

    $url = $data;

    $content .= "<!-- begin: $url -->\n";

    $fp = fopen("$url","r");

    if (!$fp) {
      $content .=" Error while opening $url ";
    } else {
      $content .= fread($fp,filesize("$url"));
    }


    fclose($fp);

    $content .= "<!-- end:$url -->\n";

    return $content;
  }

  function help($message) {
    global $dateLibraryDeploy;

    if (!$dateLibraryDeploy) {
      $content .= "\n\n<script language=\"javascript\" src=\"js/help.js\"></script>\n";
      $content .= "<link href=\"css/help.css\" rel=\"stylesheet\" type=\"text/css\">\n";
      $content .= "<div id=help></div>\n";
    }

    $content .= " <a href=#><img border=0 src=img/help.png onClick=\"showHelp(this,'$message')\"></a>";
    
    return $content;

  }


}

?>