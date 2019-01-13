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


function checkForm(nomeInput){
    togliErrore(nomeInput);
    var pattern = new RegExp('^[a-zA-Z]{4,}$')
    if (pattern.test(nomeInput.value)){
        return true;
    }else{
        mostraErrore(nomeInput, "Il campo  deve contenere almeno 4 caratteri");
        return false;
    }
}



function togliErrore(input){
    var parent = input.parentNode;
    if(parent.children.length > 1){
        parent.removeChild(parent.children[1]);
    }
}

function mostraErrore(input, testo){
    var parent = input.parentNode;
    var span = document.createElement("span");
    span.className = "messaggio-errore-form";
    span.appendChild(document.createTextNode(testo));
    parent.appendChild(span);
}

function controllaRegistrazione(){
    var nome = document.getElementById('fname');
    var cognome = document.getElementById('fcognome');
    var username = document.getElementById('fusername');
    var password = document.getElementById('fpsw');
    var risultatoTestNome = checkForm(nome);
    var risultatoTestCognome = checkForm(cognome);
    var risultatoTestUsername = checkForm(username);
    var risultatoTestPassword = checkForm(password);
    return risultatoTestNome && risultatoTestCognome && risultatoTestUsername && risultatoTestPassword;
}
