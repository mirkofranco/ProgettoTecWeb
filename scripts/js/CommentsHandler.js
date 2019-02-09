var adminButtons = document.getElementsByClassName("pannello-admin")[0];
if (adminButtons) {
    var deleteButton = adminButtons.getElementsByTagName("a")[1];

    if (deleteButton) {
        deleteButton.onclick = function() {
            return confirm("sei sicuro di voler eliminare questo prodotto?");
        }
    }
}

var sendButton = document.getElementById("send-comment");

if (sendButton)
    sendButton.onclick = function() {
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

        var newComment = document.getElementById("new-comment");
        // IE fallback
        var textContent = newComment.textContent || newComment.innerText;
        var body = {
            productId: document.getElementsByClassName("dettaglio-prodotto")[0].id,
            comment: textContent
        };

        if (!body.comment) { // se il campo è vuoto non inviare nulla
            return;
        }

        request.send(JSON.stringify(body));
    };

function commentSentCallback() {
    if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {

        if (this.responseText == 0) {
            alert("qualcosa è andato storto");
            return;
        }

        var sentComment = document.getElementById("new-comment");
        sentComment.removeAttribute("contenteditable");

        var authorText = sentComment.previousElementSibling ;
        // IE fallback
        var text = authorText.textContent || authorText.innerText;
        authorText.innerHTML = text.replace("Scrivi un commento come: ", "") + "ha scritto: ";

        var newNode = document.createElement("div");
        newNode.id="send-comment";
        newNode.innerHTML = "ricarica la pagina per inviare altri commenti";
        
        var sendButton = document.getElementById("send-comment");
        sendButton.replaceWith(newNode);
    }
}
