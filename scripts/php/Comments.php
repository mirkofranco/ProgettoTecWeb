<?php
require_once "catalogo/CustomDomDocument.php";

/**
 * Classe che assembla la lista di commenti relativa a un prodotto
 */
class CommentsListBuilder extends CustomDomDocument {
    private $productId;

    public function __construct($productId) {
        parent::__construct();
        $this->productId = $productId;
    }

    public function addCommentsList($commentsList) {
        if (empty($commentsList)) {
            return;
        }

        foreach ($commentsList as $comment) {
            $this->addComment($comment["username"], $comment["commentBody"]);
        }

    }

    private function addComment($author, $commentBody) {
        $container = $this->document->createElement("div");
        $container->setAttribute("class", "commento");
        $this->document->appendChild($container);

        $authorElement = $this->document->createElement("div", $author . " ha scritto:");
        $authorElement->setAttribute("class", "autore-commento");
        $container->appendChild($authorElement);

        $textElement = $this->document->createElement("div", $commentBody);
        $textElement->setAttribute("class", "testo-commento");
        $container->appendChild($textElement);
    }

}


// <div class="commento clearfix">
//   <div class="autore-commento">
//     nome cognome (username) ha scritto:
//   </div>
//   <div class="testo-commento">
//     lorem ipsum etc
//   </div>
// </div>
