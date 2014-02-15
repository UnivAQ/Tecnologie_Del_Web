<?php /* Smarty version 2.6.26, created on 2010-07-05 23:15:09
         compiled from prodotto.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


       
           
             <a href="macrocategorie.php?id_macrocategoria=<?php echo $this->_tpl_vars['prodotto']['id_macrocategoria']; ?>
"><?php echo $this->_tpl_vars['prodotto']['nome_macrocategoria']; ?>
</a>  >  <a href="sottocategorie.php?id_categoria=<?php echo $this->_tpl_vars['prodotto']['id_categoria']; ?>
"><?php echo $this->_tpl_vars['prodotto']['nome_categoria']; ?>
</a><br /><br />
             <a href="javascript:history.back()">< Torna indietro</a><br />
             <h1 class="inner"><?php echo $this->_tpl_vars['prodotto']['titolo']; ?>


               
                <!--Modifica prodotto-->
                <?php if ($this->_tpl_vars['prodotto']['can_edit']): ?>
                <a href="modifica.php?id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"><img align="top" class="ico" alt="modifica" src="./template/images/modifica.png"/></a>
                <?php endif; ?>
                 <!--Aggiungi specifiche-->
                <?php if ($this->_tpl_vars['prodotto']['can_add_specifiche']): ?>
                <a href="add_specifiche.php?id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"><img align="top" alt="delete" class="ico" src="./template/images/specifiche.gif"/></a>
                <?php endif; ?>
                <!--Elimina prodotto-->
                <?php if ($this->_tpl_vars['prodotto']['can_delete']): ?>
                <a href="del_prodotto.php?id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"><img align="top" alt="delete" class="ico" src="./template/images/delete.png"/></a>
                <?php endif; ?>
            </h1>
            <div><img src="img.php?id=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
" alt="" width="177" height="117" class="aboutus-img" /><br />
                <br />
                <?php echo $this->_tpl_vars['prodotto']['descrizione']; ?>
. <br />
                <br />
                <br />
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="aboutcolumn1">
                <div>
                    <h5>Specifiche</h5>
                    <?php $_from = $this->_tpl_vars['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['specifiche']):
?>
                    <?php echo $this->_tpl_vars['specifiche']['denominazione']; ?>
: <?php echo $this->_tpl_vars['specifiche']['valore']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>

                </div>
            </div>
            <div class="aboutcolumn2">
                <div>
                    <h5>Rating</h5>
                    Rating: <?php echo $this->_tpl_vars['prodotto']['rating_medio']; ?>

                    <?php if ($this->_tpl_vars['can_rate']): ?>
                    <form method="post" action="add_rate.php">
                        <input type="hidden" name="id_prodotto" value="<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"/>
                        <select name="rating">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                        </select>
                        <input type="submit" value="RATE!"/>
                    </form>
                    <?php endif; ?>


                    <div class="insidereadmore"></div>
                </div>
                <br />
                <br />
            </div>
            <div class="ourprojectrow">
                <h6 class="inner">Feedback utenti</h6>
                <?php if ($this->_tpl_vars['feed']): ?><?php $_from = $this->_tpl_vars['feed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['feedback']):
?><div class="blog-posted-row"><b><u><?php echo $this->_tpl_vars['feedback']['titolo']; ?>
</u></b> by <?php echo $this->_tpl_vars['feedback']['username']; ?>
<br /></div>
                <?php echo $this->_tpl_vars['feedback']['feedback']; ?>
<br /><br />
                Punteggio feedback: <?php echo $this->_tpl_vars['feedback']['somma_rating']; ?>

                <?php if ($this->_tpl_vars['feedback']['can_rate']): ?>
                <a target="_blank" href="add_rating_feedback.php?id_feedback=<?php echo $this->_tpl_vars['feedback']['id_feedback']; ?>
&amp;rating=plus&amp;id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
">[+]</a> <a target="_blank" href="add_rating_feedback.php?id_feedback=<?php echo $this->_tpl_vars['feedback']['id_feedback']; ?>
&amp;rating=minus">[-]</a>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['feedback']['can_delete']): ?>
                <br /><a href="del_feedback.php?id_feedback=<?php echo $this->_tpl_vars['feedback']['id_feedback']; ?>
&amp;id_prodotto=<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"><img alt="delete" class="ico" src="./template/images/delete.png"/></a>
                <br />
                <?php endif; ?>
                <br /><br />
                <?php endforeach; endif; unset($_from); ?>

                <?php else: ?>
                Non sono stati ancora rilasciati feedback<br /><br />
                <?php endif; ?>
                <?php if ($this->_tpl_vars['prodotto']['can_add_feedback']): ?>
                <form method="post" action="add_feedback.php">
                    <table>
                        <tr><td><input type="hidden" name="id_prodotto" value="<?php echo $this->_tpl_vars['prodotto']['id_prodotto']; ?>
"/></td></tr>
                        <tr><td>Titolo:</td> <td><input size="61" name="titolo" /></td></tr>
                        <tr><td>Feedback:</td> <td><textarea name="feedback" rows="4" cols="70"></textarea></td></tr>
                        <tr><td><input align="right" type="submit" value="RATE!"/></td></tr>
                    </table>
                </form>
                <?php endif; ?>
            </div>
            <div>
            </div>
       <a href="javascript:history.back()">< Torna indietro</a><br />
    


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>