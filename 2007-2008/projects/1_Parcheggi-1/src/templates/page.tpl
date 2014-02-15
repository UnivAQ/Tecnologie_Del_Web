{ include file="header.tpl" }
<body{ if $home_page or $mostra_parcheggio or $modifica_parcheggio } onload="initialize()" onunload="GUnload()"{ /if }> 

    <!-- Logo e titolo -->
    <div id="header">
    	<div id="logo">
    	</div>
    </div>
    
    <!-- Menu superiore -->
    
    <div id="navigation">
    <ul>
    	{ include file="navigation.tpl" }
    </ul>
    </div>
    
    
    <div id="container">
	<div id="secondaryContent">
	    
	    <!-- Menu laterale -->
    	{ include file="control_panel.tpl" }
	</div>

    	<!-- Contenuti -->
        <div id="primaryContent">
        	{ if $modifica_utente or $aggiungi_utente}
        		{ include file="dati_utente.tpl" }
        	{ elseif $lista_utenti }
        		{ include file="lista_utenti.tpl" }
        	{ elseif $aggiungi_auto or $modifica_auto }
        		{ include file="dati_auto.tpl" }
        	{ elseif $lista_auto }
        		{ include file="lista_auto.tpl" }
        	{ elseif $aggiungi_carta or $modifica_carta }
        		{ include file="aggiungi_carta.tpl" }
        	{ elseif $lista_carte }
        		{ include file="lista_carte.tpl" }
        	{ elseif $aggiungi_parcheggio or $modifica_parcheggio or $mostra_parcheggio }
        		{ include file="dati_parcheggio.tpl" }
        	{ elseif $lista_parcheggi }
        		{ include file="lista_parcheggi.tpl" }
        	{ elseif $aggiungi_annuncio or $approva_annuncio }
        		{ include file="dati_annuncio.tpl" }
        	{ elseif $lista_annunci }
        		{ include file="lista_annunci.tpl" }
        	{ elseif $menu_profilo }
        		{ include file="profilo.tpl" }
        	{ elseif $menu_parcheggio }
        		{ include file="parcheggio.tpl" }
        	{ elseif $menu_amministratore }
        		{ include file="admin.tpl" }
        	{ elseif $menu_messaggi }
        		{ include file="messaggi.tpl" }
        	{ elseif $home_page }
        		{ include file="home_page.tpl" }
        	{ elseif $invia_messaggio or $leggi_messaggio }
        		{ include file="dati_messaggio.tpl" }
        	{ elseif $lista_messaggi }
        		{ include file="lista_messaggi.tpl" }
        	{ elseif $lista_postoauto }
        		{ include file="lista_postoauto.tpl" }
        	{ elseif $aggiungi_postoauto or $modifica_postoauto }
        		{ include file="aggiungi_postoauto.tpl" }
        	{ elseif $aggiungi_gruppo or $modifica_gruppo }
        		{ include file="dati_gruppo.tpl" }
        	{ elseif $lista_gruppi or $lista_utentigruppo }
        		{ include file="lista_gruppi.tpl" }
        	{ elseif $aggiungi_utentegruppo }
        		{ include file="aggiungi_utentegruppo.tpl" }
        	{ elseif $cerca_parcheggio }
        		{ include file="cerca_parcheggio.tpl" }
        	{ elseif $contact }
        		{ include file="contact.tpl" }
        	{ elseif $help }
        		{ include file="help.tpl" }
        	{ elseif $prenota_sosta }
        		{ include file="prenota_sosta.tpl" }
        	{ elseif $lista_soste }
        		{ include file="lista_soste.tpl" }
        	{ else }
        		{ $content }
        	{ /if }
    	</div>
        <br class="clear" />
    </div>


{ include file="footer.tpl" }

</body>
</html>
 
