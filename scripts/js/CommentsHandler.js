
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