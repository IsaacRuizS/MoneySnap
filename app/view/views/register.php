<?php
    /*session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }*/
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once '../components/head_common.php'; ?>
        <script src="../js/register.js"></script>
        <title>Registro</title>
    </head>
    <body class="bg-white">
        <div class="container d-flex justify-content-center align-items-center contenedor-principal">
            <div class="card shadow p-4 tarjeta-formulario">
                
                <div class="d-flex justify-content-center mb-3">
                    <img src="../assets/MoneySnapLogo.png" alt="Money Snap" class="img-fluid logo" style="width: 150px; height: 150px; border-radius: 10px;">
                </div>

                <h3 class="text-center mb-3">Crear Cuenta</h3>

                <div id="alert" class="alert d-none" role="alert"></div>

                <form method="POST" id="registerForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 boton-registro">Registrarse</button>
                </form>

                <div class="mt-3 text-center">
                    <p>¿Ya tienes una cuenta? <a href="login.php" class="enlace">Inicia sesión</a></p>
                </div>
            </div>
        </div> 
    </body>
</html>
