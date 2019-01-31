<?php
require_once "catalogo/CustomDomDocument.php";

class CommentsListBuilder extends CustomDomDocument {
    private $productId;

    public function __construct($productId) {
        parent::__construct();
        $this->productId = $productId;
    }

    public function addCommentsList($commentsList) {
    }

    private function addComment($comment) {
    }

}

class Comment {
    private $user;
    private $productId;
    private $message;

    public function __construct($user, $productId, $message) {
        $this->user = $user;
        $this->productId = $productId;
        $this->message = $message;

    }
}

// <div class="commento clearfix">
//   <div class="autore-commento">
// xxxx ha scritto:
//   </div>
//   <div class="testo-commento">

//   </div>
// </div>
