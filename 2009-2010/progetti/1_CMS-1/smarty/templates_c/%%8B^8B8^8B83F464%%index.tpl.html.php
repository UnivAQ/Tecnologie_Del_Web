<?php /* Smarty version 2.6.26, created on 2010-07-05 22:53:05
         compiled from admin/index.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>HI-TECH REVIEW</title>
        <link href="/template/style/style.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <div id="wrapper">
            <div class="headerzone">
                <div class="header">
                    <div class="headerText">HI-TECH REVIEW</div>
                    <div class="login">
                        <?php if ($this->_tpl_vars['logged']): ?>

                        Benvenuto <?php echo $this->_tpl_vars['username']; ?>
<br />
                        <a class="img" href="/pannello_utente.php"><img align="middle" src="/template/images/pannello_utente.png" class="ico" alt="pannello"/></a>
                        <?php if ($this->_tpl_vars['admin']): ?>
                        &nbsp;<a class="img" href="/admin/index.php" ><img align="middle" src="/template/images/admin.png" class="ico" alt="pannello"/></a>
                        <?php endif; ?>
                        &nbsp;<a class="img" href="/logout.php"><img  align="middle" src="/template/images/logout.png" class="ico" alt="logout"/></a>
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
                                    <script language="javascript" src="../menu.php"></script>

                                </div>

                                <div class="clear"></div>
                            </div>
                            <div class="workZoneRight">
                                <div class="rightBox inner">
                                    
                                    <?php if ($this->_tpl_vars['servizi']): ?>
                                    <div align="center"  style="font-size: 15px;"><b>AGGIUNGI SERVIZI A GRUPPI</b></div><br /><br />
                                    <table>
                                        <tr>
                                            <td></td>
                                            <td>Inserimento prodotti</td>
                                            <td>Rilascio rating prodotti</td>
                                            <td>Rilascio feedback</td>
                                            <td>Rilascio rating feedback</td>
                                            <td>Modifica prodotti</td>
                                            <td>Rimozione commenti</td>
                                            <td>Rimozione prodotti</td>
                                            <td></td>
                                        </tr>
                                        <?php $_from = $this->_tpl_vars['servizi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['gruppo']):
?>
                                        <form method="post" action="">
                                            <input type="hidden" name="mod_servizi"/>
                                                <input type="hidden" name="id_gruppo" value="<?php echo $this->_tpl_vars['gruppo']['id_gruppo']; ?>
"/>
                                                    <tr>
                                                        <td><b style="font-size:13px;"><?php echo $this->_tpl_vars['gruppo']['nome']; ?>
</b></td>
                                                        <td><input type="checkbox" size=1 name="2" <?php if ($this->_tpl_vars['gruppo'][2]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="checkbox" size=1 name="3" <?php if ($this->_tpl_vars['gruppo'][3]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="checkbox" size=1 name="4" <?php if ($this->_tpl_vars['gruppo'][4]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="checkbox" size=1 name="5" <?php if ($this->_tpl_vars['gruppo'][5]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="checkbox" size=1 name="6" <?php if ($this->_tpl_vars['gruppo'][6]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="checkbox" size=1 name="7" <?php if ($this->_tpl_vars['gruppo'][7]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="checkbox" size=1 name="8" <?php if ($this->_tpl_vars['gruppo'][8]): ?> checked="checked"<?php endif; ?>/></td>
                                                        <td><input type="submit" value="Salva"/></td>
                                                    </tr>
                                                    </form>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                    </table>
                                                    <?php else: ?>
                                                    <b>Nessun gruppo presente</b><br /><br />
                                                    <?php endif; ?>
                                                    <br />
                                                    <b>Aggiungi gruppo</b> <form method="post" action=""><input type="hidden" name="add_gruppo"/>
                                                        <input type="text" name="nome"/>
                                                        <input type="submit" value="Aggiungi"/>
                                                    </form>

                                                    <hr />
                                                    <br />
                                                    <div align="center" style="font-size:15px;"><b>ASSOCIA UTENTI A GRUPPI</b></div><br />
                                                    <br />
                                                    
                                                    <table>
                                                        <tr>
                                                            <td></td>
                                                            <td>Lista gruppi utente</td>
                                                            <td></td>
                                                            <td>&nbsp;</td>
                                                            <td>Aggiungi gruppo</td>
                                                            <td></td>
                                                        </tr>
                                                        <?php $_from = $this->_tpl_vars['utenti']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['utente']):
?>
                                                        <tr>

                                                            <td><b style="font-size:13px;"><?php echo $this->_tpl_vars['utente']['username']; ?>
</b></td>
                                                            <td>
                                                                <form method="post" action="">
                                                                    <input type="hidden" name="del_gruppo_utente"/>
                                                                    <input type="hidden" name="id_utente" value="<?php echo $this->_tpl_vars['utente']['id_utente']; ?>
"/>
                                                                    <select name="id_gruppo">
                                                                        <?php $_from = $this->_tpl_vars['utente']['gruppi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gruppi_utente']):
?>
                                                                        <option value="<?php echo $this->_tpl_vars['gruppi_utente']['id_gruppo']; ?>
"><?php echo $this->_tpl_vars['gruppi_utente']['nome_gruppo']; ?>
</option>
                                                                        <?php endforeach; endif; unset($_from); ?>
                                                                    </select>

                                                            </td>
                                                            <td><input type="submit" value="CANCELLA!"/></td>
                                                            </form>
                                                            <td></td>
                                                            <td>
                                                                <form method="post"  action="">
                                                                    <input type="hidden" name="add_gruppo_utente"/>
                                                                    <input type="hidden" name="id_utente" value="<?php echo $this->_tpl_vars['utente']['id_utente']; ?>
"/>
                                                                    <select name="id_gruppo">
                                                                        <?php $_from = $this->_tpl_vars['gruppi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gruppo']):
?>
                                                                        <option value="<?php echo $this->_tpl_vars['gruppo']['id_gruppo']; ?>
"><?php echo $this->_tpl_vars['gruppo']['nome_gruppo']; ?>
</option>
                                                                        <?php endforeach; endif; unset($_from); ?>
                                                                    </select>


                                                            </td>
                                                            <td><input type="submit" value="AGGIUNGI!"></td>
                                                            </form>
                                                        </tr>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </table>
                                                    <br />
                                                    <hr />
                                                    <br />
                                                        <div align="center" style="font-size:15px;"><b>GESTISCI CATEGORIE</b> </div><br />
                                                            <?php $_from = $this->_tpl_vars['macrocategorie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['macrocategoria']):
?>
                                                        
                                                            <b style="font-size:13px;">+&nbsp;<?php echo $this->_tpl_vars['macrocategoria']['nome_macrocategoria']; ?>
</b><a href="index.php?del_macro&id_macrocategoria=<?php echo $this->_tpl_vars['macrocategoria']['id_macrocategoria']; ?>
"><img width="20" height="20" style="border-style: none" alt="delete" src="/template/images/delete.png" /></a><br />
                                                                <?php $_from = $this->_tpl_vars['macrocategoria']['sotto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                                                &nbsp; - &nbsp;<?php echo $this->_tpl_vars['item']['nome_categoria']; ?>
<a href="index.php?del_cat&id_categoria=<?php echo $this->_tpl_vars['item']['id_categoria']; ?>
"><img width="15" height="15" style="border-style: none" alt="delete" src="/template/images/delete.png" /></a><br />
                                                                
                                                                <?php endforeach; endif; unset($_from); ?>
                                                        
                                                        <form method="post" action="">
                                                            <input type="hidden" name="add_cat"/>
                                                            <input type="hidden" name="id_macrocategoria" value="<?php echo $this->_tpl_vars['macrocategoria']['id_macrocategoria']; ?>
"/><br />
                                                            <input name="nome_categoria"/>
                                                            <input type="submit" value="Aggiungi"/>
                                                        </form><br /><br />
                                                        <?php endforeach; endif; unset($_from); ?>
                                                        <hr />
                                                        <br />
                                                        <div align="center" style="font-size:15px;"<b>AGGIUNGI MACROCATEGORIE</b></div><br/><br />
                                                        <form method="post" action="">
                                                            <input type="hidden" name="add_macro"/>
                                                            <input name="nome_macrocategoria"/>
                                                            <input type="submit" value="Aggiungi"/>
                                                        </form>


                                                        </div>
                                                        <div class="clear"></div>
                                                        </div>
                                                        <div class="clear"></div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                        </div>
                                                        <div class="footer">
                                                            <ul style="color:#FFF;">
                                                                <li> Copyright (c) Hi-Tech Review All rights reserved. Design by hitechreview.com.</li>
                                                            </ul>
                                                        </div>
                                                        </div>
                                                        </body>
                                                        </html>