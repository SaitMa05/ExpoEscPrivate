<?php

    include './includes/app.php';

    pageLogin();
    
    
    use App\Login;

    $errores = Login::getErrores();
    // ver($errores);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = new Login($_POST);

        $errores = $login->validar();
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
        <section class="login">
            <div class="login-cont">
                <h2 class="login-titulo">Iniciar Sesión</h2>
                <?php foreach($errores as $error): ?>
                    <div class="alerta error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
                <form class="login-form" method="POST">
                    <div class="login-form-group">
                        <label for="email" class="login__form-label">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="login__form-input" placeholder="Correo Electrónico">
                    </div>
                    <div class="login-form-group">
                        <label for="password" class="login__form-label">Contraseña</label>
                        <!-- Neccesito el icono para ver la contrasena -->
                        <i class="fas fa-eye login-form-icon"></i>
                        <input type="password" id="password" name="password" class="login__form-input" placeholder="Contraseña">
                    </div>
                    <button class="login-form-button">Iniciar Sesión</button>
                </form>
            </div>
        </section>

    </div>

</body>
</html>