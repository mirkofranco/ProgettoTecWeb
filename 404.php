<?php
    $daSostituire = array(
        "{{pageTitle}}" => "404: Page Not Found! - Studio AR",
        "{{pageDescription}}" => "pagina di errore 404",
        "{{pageKeywords}}" => " "
    );

    $customMessage = "<p>Purtroppo l'indirizzo " . $_SERVER["REQUEST_URI"] . " non esiste su questo sito!</p>";

    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio_user.html'));
    echo str_replace("{{requestedUrl}}", $customMessage, file_get_contents('./static/404.html'));
    echo file_get_contents('./static/_fine.html');
?>
