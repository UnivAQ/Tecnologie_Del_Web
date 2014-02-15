<?php

namespace tdw\app;

class Signup extends HomeAbstract
{
    protected
    function _run() {
        $temp=false;
        $this->_map['signup_errors'][] = array();
        //il modulo non è stato ancora inviato
        if(isset($_POST['signup'])) {

            if(!$_POST['name']) {
                $this->_map['signup_errors']['name'] = 'name';
                $temp = true;
            }
            if(!$_POST['surname']) {
                $this->_map['signup_errors']['surname'] ='surname';
                $temp = true;
            }
            if(!$_POST['username']) {
                $this->_map['signup_errors']['username'] = 'username';
                $temp = true;
            }
            //array di caratteri non ammessi
            $bad = array('\'','.',',','/','`',';','[',']','-','*','&','^','%','$','#','@','!','~','+','(',')','|','{','}','<','>','?',':','"', '=');
            //controlla lunghezza username
            $len = strlen($_POST['username']);

            //sostituisce caratteri non ammessi
            $cleaned_username = str_replace($bad, '', $_POST['username']);
            //se le lunghezze sono differenti sono stati utilizzati caratteri non ammessi
            if(strlen($cleaned_username) == $len) {
                //Controlla se l'username è già utlizzato nel database
                $q2 = mysql_query("SELECT * FROM `operators` WHERE `uid` = '".$_POST['username']."'");

                while ($q3 = mysql_fetch_object($q2)) {

                    if($q3->uid == $_POST['username']) {
                        $this->_map['signup_errors']['username'] = 'exist_username';
                        $temp = true;
                    }
                }
            }
            else {
                $this->_map['signup_errors']['username'] = 'invalid_username';
                $temp = true;
            }

            //controlla dati relativi alla password
            if(!$_POST['password']) {
                $this->_map["signup_errors"]['password'] = 'password';
                $temp = true;
            }
            if(!$_POST['verify_password']) {
                $this->_map['signup_errors']['password'] = 'ver_password';
                $temp = true;
            }
            if($_POST['password'] != $_POST['verify_password']) {
                $this->_map['signup_errors']['password'] = 'diff_password';
                $temp = true;
            }
            if(($_POST['password'] != "")
                && ($_POST['password'] == $_POST['verify_password'])
                && \strlen($_POST['password']) < 6
                && \strlen($_POST['verify_password']) < 6 ) {
                    $this->_map['signup_errors']['password'] = 'short_password';
                    $temp = true;
                }

                
            if(!$_POST['email']) {
                $this->_map['signup_errors']['email'] = 'email';
                $temp = true;
            }
            if(!$_POST['phone']) {
                $this->_map['signup_errors']['phone'] = 'phone';
                $temp = true;
            }
            if(!$_POST['address']) {
                $this->_map['signup_errors']['address'] = 'address';
                $temp = true;
            }
            if(!$_POST['cap']) {
                $this->_map['signup_errors']['cap'] = 'cap';
                $temp = true;
            }
            if(!$_POST['city']) {
                $this->_map['signup_errors']['city'] = 'city';
                $temp = true;
            }
            if(!$_POST['province']) {
                $this->_map['signup_errors']['province'] = 'province';
                $temp = true;
            }
            if(!$_POST['state']) {
                $this->_map['signup_errors']['state'] = 'state';
                $temp = true;
            }

            //Inserisce il nuovo membro nel database
            if (!$temp) {
                $sql ="INSERT INTO `operators` (uid, pass) VALUES ('".$_POST['username']."','".md5($_POST['password'])."')";
                $result = mysql_query($sql);

                $id = \mysql_insert_id();
                $sql ="INSERT INTO `operators_infos` (operator_id, name, surname, email, address, cap, city, province, state, telephone) VALUES ('".$id."','".$_POST['name']."','".$_POST['surname']."','".$_POST['email']."','".$_POST['address']."','".$_POST['cap']."','".$_POST['city']."','".$_POST['province']."','".$_POST['state']."','".$_POST['phone']."')";
                $result = mysql_query($sql);

                $sql = "INSERT INTO operators_groups (operator_id, group_id) VALUES ('{$id}', '2')";
                $result = mysql_query($sql);

                /* INSERT INTO operators_groups (operator_id, group_id) VALUES ('{$id}', '2') */

                /*$query = \mysql_query("SELECT * FROM operators AS o LEFT JOIN operators_infos AS i ON o.id = i.info_id
                                WHERE o.id = ".$_GET['id']);*/

                /*if(!$insert2) die(mysql_error());
			if(!$insert4) die(mysql_error());*/
                return 'blocks/signup-confirm';
            }
            else {
                return 'signup';
            }
        }
        return 'signup';
    }
}
?>
