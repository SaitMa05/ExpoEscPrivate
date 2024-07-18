<?php

// Importar la conexión
require 'includes/app.php';
$db = conectarDB();

// Crear un email y password
$nombre = "MEM";
$email = "mati@mati.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);


// Query para crear el usuario
$query = " INSERT INTO usuarios (nombre,email, password) VALUES ( '${nombre}','${email}', '${passwordHash}'); ";

// echo $query;

// Agregarlo a la base de datos
mysqli_query($db, $query);