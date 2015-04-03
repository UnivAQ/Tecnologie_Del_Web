<?php /* Smarty version 2.6.26, created on 2010-07-06 09:41:07
         compiled from header.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <script type="text/javascript" src="./template/js/controlli.js"></script>
        <title>HI-TECH REVIEW</title>
        <link href="./template/style/style.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <div id="wrapper">
            <div class="headerzone">
                <div class="header">
                    <div class="headerText"></div>
                    <div class="login">
                        <?php if ($this->_tpl_vars['logged']): ?>

                        Benvenuto <?php echo $this->_tpl_vars['username']; ?>
<br />
                        <a class="img" href="pannello_utente.php"><img align="middle" src="./template/images/pannello_utente.png" class="ico" alt="pannello"/></a>
                        <?php if ($this->_tpl_vars['admin']): ?>
                        &nbsp;<a class="img" href="admin/index.php" ><img align="middle" src="./template/images/admin.png" class="ico" alt="pannello"/></a>
                        <?php endif; ?>                     
                        &nbsp;<a class="img" href="logout.php"><img  align="middle" src="./template/images/logout.png" class="ico" alt="logout"/></a>
                        <?php else: ?>
                       
                        <form method="post" action="login.php">
                            <input type="text" name="username" />
                            <input type="password" name="password" />
                            <input type="submit" name="op" value="LOGIN"  class="form-submit" />
                        </form>
                        
                        <?php endif; ?>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="topmenu">
                    <ul>
                       <li></li>
                        <li><a href="/index.php">Home</a></li>

                        <li><a href="/categorie.php">Categorie</a></li>
                        <li><a href="/registrazione.php?tipo=1">Registrazione Utente</a></li>
                        <li><a href="/registrazione.php?tipo=2">Registrazione Aziende</a></li>
                        
                        <li><a href="/ricerca.php">Ricerca</a></li>

                       
                     

                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="workZone">
                <div class="midBox">
                    <div class="topBox">
                        <div class="bottomBox">
                            <div class="leftBox">
                                <div class="box1">
                                    <h2>CATEGORIE</h2>
                                    <script language="javascript" src="menu.php"></script>

                                </div>

                                <div class="clear" ></div>
                            </div>
                            <div class="workZoneRight">
                                <div class="rightBox inner" id="corpo">