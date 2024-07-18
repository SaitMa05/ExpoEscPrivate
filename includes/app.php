<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once 'includes/funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';
if(!session_start()) {
    session_start();
}

$db = conectarDB();

use App\Personas;
use App\Login;

Personas::setDB($db);
Login::setDB($db);

// use App\Prueba;
