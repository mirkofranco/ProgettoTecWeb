
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
    var pattern = new RegExp('^[a-zA-Z0-9 ?!()".;,:-_àòùèìé"]{20,}$');
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


document.getElementById("send-comment").onclick = function() {
  var request;

  if (window.XMLHttpRequest) {
    request = new XMLHttpRequest();
  } else {
    // supporto per IE5, IE6
    request = new ActiveXObject("Microsoft.XMLHTTP");
  }

  request.open("POST", "inserisci_commento.php", true);
  request.setRequestHeader("Content-type", "application/json");
  request.onreadystatechange = commentSentCallback;

  var body = {
    productId: document.getElementsByClassName("dettaglio-prodotto")[0].id,
    comment: document.getElementById("new-comment").innerHTML
  };

  if (!body.comment) { // se il campo è vuoto non inviare nulla
      return;
  }

  request.send(JSON.stringify(body));
};

function commentSentCallback() {
  if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {

    if (this.responseText==0) {
      alert("qualcosa è andato storto");
      return;
    }

    document.getElementById("new-comment").removeAttribute("contenteditable"); 
    var hidethis = document.getElementById("send-comment").parentElement;
    hidethis.classList.add("hidden");
    hidethis.setAttribute("hidden","hidden");
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
