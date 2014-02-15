function verificaProdotto()
{
    /*if (document.form.radio.value!='accetta'){
alert("devi accettare il contratto per iscriverti");
return;
}*/

    //Controlla la presenza dei campi username e password
    if(document.ins_prod.titolo.value.length<4)
    {
        alert("Inserire un titolo valido");
        document.ins_prod.titolo.focus();
        return false;
    }

    if (document.ins_prod.descrizione.value.length < 1 )
    {
        alert("Inserire una descrizione valida");
        document.ins_prod.descrizione.focus();
        return false;
    }

//alert(document.ins_prod.id_categoria);
//return false;
    //Controlla se è selezionata la sottocategoria
    if(typeof(document.ins_prod.id_categoria)=="undefined")
    {
        alert("Selezionare una categoria");
        return false;
    }

    return true;
}

function verificaRegUtente()
{
    /*if (document.form.radio.value!='accetta'){
alert("devi accettare il contratto per iscriverti");
return;
}*/

    //Controlla la presenza dei campi username e password
    if(document.reg_utente.username.value.length<4)
    {
        alert("Inserire un username di almeno 4 lettere");
        document.reg_utente.username.focus();
        

        return false;
    }

    if (document.reg_utente.password.value.length < 4 )
    {
        alert("Inserire una password di almeno 4 caratteri");
        document.reg_utente.password.focus();
        return false;
    }



    var stato=true;


    if(document.reg_utente.email.value.indexOf(" ")!=-1) {
        document.reg_utente.email.focus();
        stato=false;
    }

    var chiocciola=document.reg_utente.email.value.indexOf("@");
    if(chiocciola<2) {
        document.reg_utente.email.focus();
        stato=false;
    }

    var punto=document.reg_utente.email.value.indexOf(".", chiocciola);
    if(punto<chiocciola+3) {
        document.reg_utente.email.focus();
        stato=false;
    }

    var lung=document.reg_utente.email.value.length;
    if(lung-punto<3) {
        document.reg_utente.email.focus();
        stato=false;
    }

    if(stato==false){
        alert("E-mail non valida");
        document.reg_utente.email.focus();
        return false;
    }

    document.reg_utente.action="";
    return true;
}


