<?php



function estaAutenticado() : void{

    if(!$_SESSION['login']) {
        header('Location: /expoesc/login.php');
    }
}
function pageLogin() : void{
    if(empty($_SESSION['login'])) {
        $_SESSION['login'] = false;
    }
    if($_SESSION['login']) {
        header('Location: /expoesc/index.php');
    }
}

function ver($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}