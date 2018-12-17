function controllaMail(){
    var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
    if (!email_reg_exp.test(document.getElementById('femail').value) || (document.getElementById('femail').value == "")) {
        document.getElementById('erroriForm').innerHTML = 'Il contenuto di \'email\' non è una mail valida';
    }else{
        document.getElementById('erroriForm').innerHTML = "";
    }
}

function jsAttivo(){
    document.getElementById('forJs').disabled = false;
}
//se js è abilitato, questo attiva una casella di testo sentinella

// l'ho commentato perché da errore quando carico pagine; se non vi serve eliminatelo pure -Luca
// $(
//     function(){
//         $("#dataInizioPrezzo").datepicker();
//     }
// );
