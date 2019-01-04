//function controllaMail(){
//    var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
//    if (!email_reg_exp.test(document.getElementById('femail').value) || (document.getElementById('femail').value == "")) {
//        document.getElementById('messaggio-errore-form').innerHTML = 'La mail non è valida';
//    }else{
//        document.getElementById('messaggio-errore-form').innerHTML = "";
//    }
//}

function jsAttivo(){
    document.getElementById('forJs').disabled = false;
    //document.getElementById('messaggio-errore-form').innerHTML = "";
}
//se js è abilitato, questo attiva una casella di testo sentinella

// l'ho commentato perché da errore quando carico pagine; se non vi serve eliminatelo pure -Luca
$(
     function(){
         $("#dataInizioPrezzo").datepicker();
    }
);



function controllaRegistrazione(){
    if('1' == '1'){
        document.getElementById('messaggio-errore-form').innerHTML = "Il nome deve contenere almeno 4 caratteri";
        return false;
    }
    return true;
}
