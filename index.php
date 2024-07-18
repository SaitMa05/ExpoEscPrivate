<?php

    include './includes/app.php';
    estaAutenticado();

    use App\Personas;

    $query = " SELECT nombre FROM usuarios WHERE email = '$_SESSION[usuario]'";
    $resultado = $db->query($query);
    $nombre = $resultado->fetch_object();
    $nombre = $nombre->nombre;

    $errores = Personas::getErrores();
    // ver($errores);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $persona = new Personas($_POST);

        $errores = $persona->validar();
        
        if(empty($errores)){
            $resultado = $persona->guardar();
        }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expo Escuela</title>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="icon" href="build/img/logo.png">
</head>
<body>
    
    <div id="app">
        <h1>Expo Escuela</h1>
        <section class="registro">
            <div class="registro-cont">
                <h2 class="registro-titulo">Registrar Personas</h2>
                <?php foreach($errores as $error): ?>
                    <div class="alerta error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
                <div class="alerta"><p class="alerta-text"></p></div>
                <form class="registro-form" method = "POST">
                    <div class="registro-form-group">
                        <label for="nombre" class="registro__form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="registro__form-input" placeholder="Nombre">
                    </div>
                    <div class="registro-form-group">
                        <label for="apellido" class="registro__form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="registro__form-input" placeholder="Apellido">
                    </div>
                    <div class="registro-form-group">
                        <label for="acompanantes" class="registro__form-label">Cantidad de acompañantes</label>
                        <input type="number" id="acompanantes" name="acompanantes" class="registro__form-input acompananteInput" placeholder="Cantidad de acompañantes" min="0" max="3">
                    </div>
                    <div class="registro-form-group">
                        <label for="ingreso" class="registro__form-label">Fecha de Ingreso</label>
                        <input type="datetime-local" id="ingreso" name="ingreso" class="registro__form-input" placeholder="Contraseña">
                    </div>
                    <button class="registro-form-button">Registrar Persona</button>
                </form>
                <p class="info-registro">Para el ingrso puede ser automaticamente o manul. Para que sea automatico basta con dejar el campo de este mismo vacio.</p>
                <p class="info-registro">La cantidad de acompanantes puede ir vacio si es requerido</p>
            </div>
        </section>
        <div class="controls">
            <a href="cerrar-sesion.php">Cerrar Sesion</a>
            <p><?php echo $nombre ?></p>
            <a href="./admin/">Panel de Control</a>
        </div>
    </div>

    <script src="src/js/app.js"></script>

</body>
</html>