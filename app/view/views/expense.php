<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once '../components/head_common.php'; ?>
        <script src="../js/expenses.js"></script>
        <title>MoneySnap - Registrar Gasto</title>
    </head>
    <body>
        <?php require_once '../components/header_common.php'; ?>

        <div class="d-flex">
            <?php require_once '../components/sidebar.php'; ?>

            <main class="main-content p-4 w-100">
                <h2 class="mb-4">Registrar Nuevo Gasto</h2>
                <p class="text-muted">Utiliza este formulario para añadir tus gastos.</p>

                <div class="card form-card shadow-sm">
                    <div class="card-body">
                        <div id="alert" class="alert d-none" role="alert"></div>

                        <form id="expenseForm">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Monto (₡)</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Ej: 2500.00" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Categoría</label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Ej: Comida, Transporte, Entretenimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción (Opcional)</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Detalles del gasto"></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-money">Agregar Gasto</button>
                                <button type="button" id="clearFormBtn" class="btn btn-outline-secondary">Limpiar Formulario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
