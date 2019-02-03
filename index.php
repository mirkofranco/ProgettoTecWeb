<?php
    require_once('./scripts/php/Sessione.php');
    require_once('./scripts/php/Utente.php');
    Sessione::startSession();
    $gestioneLogin = "";
    if(!isset($_SESSION['user'])){
        $gestioneLogin = "<a href=\"login.php\" class=\"header-button\" >Login</a><a href=\"registrazione.php\" class=\"header-button\" >Registrati</a>";
    }else{
        if($_SESSION['user'] -> getPermessi() == '11'){
            $gestioneLogin .= "<a href=\"menu_admin.php\" class=\"header-button\">Area riservata</a>";
        }
        $gestioneLogin .= "<a href=\"logout.php\" class=\"header-button\">Logout</a>";
    }
    $daSostituire = array(
        "{{pageTitle}}" => "Home - Studio AR",
        "{{pageDescription}}"=>"Studio di architetti esperti di arredamento e di design di interni, che ti possono aiutare a creare la vita dei tuoi sogni in una casa che rispecchia il tuo stile di vita.",
        "<li class=\"flex-element\"><a href=\"./index.php\"><span lang=\"en\" class=\"prova\">Home</span></a></li>" => "<li class=\"flex-element current-page\"><span lang=\"en\" class=\"prova\">Home</span></a></li>",
        "<a href=\"./index.php\" class=\"clickable-content\">\n        <img src=\"./images/logo/logo.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\" />\n      </a>" => "<img src=\"./images/logo/logo.png\" id=\"logo\" alt=\"Studio Architetti Riuniti\" />",
        "{{gestioneLogin}}" => $gestioneLogin
    );

    // $baseFilename = basename($_SERVER["PHP_SELF"],".php");
    // // regex per rimuovere i link circolari;
    // $pattern = '/<a.*?href="\.\/' . $baseFilename . '\.php".*>(?: |\n)*(.+?)(?: |\n)*<\/a>/s';
    // $replace = '<div class="current-page">$1</div>';

    // echo str_replace(array_keys($daSostituire), array_values($daSostituire), preg_replace($pattern, $replace, file_get_contents('./static/_inizio.html')));
    echo str_replace(array_keys($daSostituire), array_values($daSostituire), file_get_contents('./static/_inizio.html'));
    echo file_get_contents('./static/index.html');
    echo file_get_contents('./static/_fine.html');
?>
