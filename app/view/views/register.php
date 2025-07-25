<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once '../components/head_common.php'; ?>
    <title>Registro</title>
</head>
<body class="bg-white">
    <div class="container d-flex justify-content-center align-items-center contenedor-principal">
        <div class="card shadow p-4 tarjeta-formulario">
            
            <div class="d-flex justify-content-center mb-3">
                <img src="../assets/MoneySnapLogo.png" alt="Money Snap" class="img-fluid logo"
                style="width: 150px; height: 150px; border-radius: 10px;">
            </div>

            <h3 class="text-center mb-3">Crear Cuenta</h3>

            <form method="POST" action="registro.php">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" required>
                </div>

                   <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" id="apellido" required>
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