<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once '../components/head_common.php'; ?>
        <script src="../js/user.js"></script>
        <title>MoneySnap - Perfil de Usuario</title>
    </head>
    <body>
        <?php require_once '../components/header_common.php'; ?>

        <div class="d-flex">
            <?php require_once '../components/sidebar.php'; ?>

            <main class="main-content p-4 w-100">
                <h2 class="mb-4">Perfil de Usuario</h2>
                <p class="text-muted">Aquí puedes ver y actualizar tu información personal.</p>

                <div class="card form-card shadow-sm">
                    <div class="card-body">
                        <div id="alert" class="alert d-none" role="alert"></div>

                        <form id="userForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-money">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div> 
    </body>
</html>
