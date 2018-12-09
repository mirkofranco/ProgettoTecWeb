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
