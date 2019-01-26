
//se js è abilitato, questo attiva una casella di testo sentinella

// l'ho commentato perché da errore quando carico pagine; se non vi serve eliminatelo pure -Luca
//$(
//     function(){
//         $("#dataInizioPrezzo").datepicker();
//    }
//);

function loadDataPicker(){
    var data = document.getElementById('dataInizioPrezzo');
    if(data.type != "date"){
         $("#dataInizioPrezzo").datepicker();
    }
}


function checkForm(nomeInput){
    togliErrore(nomeInput);
    var pattern = new RegExp('^[a-zA-Z]{4,}$')
    if (pattern.test(nomeInput.value)){
        return true;
    }else{
        mostraErrore(nomeInput, "Il campo deve contenere almeno 4 caratteri");
        return false;
    }
}

function checkPassowrd(nomeInput){
    togliErrore(nomeInput)
    var pattern = new RegExp('^[a-zA-Z0-9]{4,}$');
    if(pattern.test(nomeInput.value)){
        return true;
    }else{
        mostraErrore(nomeInput, "La password deve contenere almeno 4 caratteri alfanumerici");
        return false;
    }
}

function checkCommento(nomeInput){
    togliErrore(nomeInput);
    var pattern = new RegExp('^[a-zA-Z0-9 ?!()".;,:-_àòùèì"]{20,}$');
    if(pattern.test(nomeInput.value)){
        return true;
    }else{
        mostraErrore(nomeInput, "Il commento deve contenere almeno 20 caratteri");
        return false;
    }
}

function checkDescrizioneProdotto(nomeInput){
    togliErrore(nomeInput);
    var pattern = new RegExp('^[a-zA-Z0-9 ?!()".;,:-_àòùèì"]{10,}$');
    if(pattern.test(nomeInput.value)){
        return true;
    }else {
        mostraErrore(nomeInput, "La descrizione deve contenere almeno 10 caratteri");
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
    var risultatoTestPassword = checkPassowrd(password);
    return risultatoTestNome && risultatoTestCognome && risultatoTestUsername && risultatoTestPassword;
}

function controllaConsulenza(){
    var nome = document.getElementById('fname');
    var commento = document.getElementById('comment');
    var risultatoNome = checkForm(nome);
    var risutatoCommento = checkCommento(commento);
    return risultatoNome && risutatoCommento;
}

function controllaInserimentoProdotto(){
    var nome = document.getElementById('nomeProdotto');
    var marca = document.getElementById('marcaProdotto');
    var descrizione = document.getElementById('Descrizione');
    var risultatoNome = checkForm(nome);
    var risultatoMarca = checkForm(marca);
    var risultatoDescrizione = checkDescrizioneProdotto(descrizione);
    return risultatoNome && risultatoMarca && risultatoDescrizione;
}

var richiesta;

function inserisciCommento(id){
    if(window.XMLHttpRequest){
        richiesta = new XMLHttpRequest();
    }else{
        //for IE5, IE6
        richiesta = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "inserisciCommento.php?id=" +  encodeURIComponent(document.getElementsByClassName("dettaglio-prodotto")[0].id) + "&" + "commento=" + encodeURIComponent(document.getElementById("commento").innerHTML) ;
    alert(url);
    richiesta.open("GET", url, true);
    richiesta.onreadystatechange = risultatoCommento;
    richiesta.send(null);
}

function risultatoCommento(){
    if( richiesta.readyState == 4 && richiesta.status == 200){
        alert(richiesta.responseXML);
        /*if(richiesta.responseXML) == "0"){
            alert("Qualcosa è andato storto");
        }*/
    }
}

// TODO finire questa roba?
// function handleLinksToSamePage() {
//   var url = window.location.pathname;
//   var filename = "." + url.substring(url.lastIndexOf('/'));

//   document.querySelectorAll('a[href="'+filename+'"]').forEach(element => {
//     var parent = element.parentNode;
//     parent.classList.add("current-page")

//     while (element.firstChild)
//       parent.insertBefore(element.firstChild, element);

//     parent.removeChild(element);
//   });
// }
