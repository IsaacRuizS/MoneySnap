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
    <script src="../js/income.js"></script>
    <title>MoneySnap - Registrar Ingreso</title>
</head>
<body>
    <?php require_once '../components/header_common.php'; ?>

    <div class="d-flex">
        <?php require_once '../components/sidebar.php'; ?>

        <main class="main-content p-4 w-100">
            <h2 class="mb-4">Registrar Nuevo Ingreso</h2>
            <p class="text-muted">Utiliza este formulario para añadir tus ingresos.</p>

            <div class="card form-card shadow-sm">
                <div class="card-body">
                    <div id="alert" class="alert d-none" role="alert"></div>

                    <form id="incomeForm">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Monto (₡)</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Ej: 50000.00" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Categoría</label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Ej: Salario, Venta, Regalo" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción (Opcional)</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Detalles del ingreso"></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-money">Agregar Ingreso</button>
                            <button type="button" id="clearFormBtn" class="btn btn-outline-secondary">Limpiar Formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
