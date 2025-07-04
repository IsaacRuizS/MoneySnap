<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-white">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

                <div class="d-flex justify-content-center mb-3">
                    <img src="../assets/MoneySnapLogo.png" alt="Money Snap" class="img-fluid" 
                    style="width: 150px; height: 150px; border-radius: 10px;">
                </div>

                <h3 class="text-center mb-3">Iniciar Sesión</h3>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" style="background-color: #28976E !important">Ingresar</button>
                </form>

                <div class="mt-3 text-center">
                    <p>¿No tienes una cuenta? <a href="register.php" style="color: #28976E !important">Crea una aquí</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
