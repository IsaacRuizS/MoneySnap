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
    <title>Inicio</title>
</head>

<body>
    <?php require_once '../components/header_common.php'; ?>

    <div class="d-flex">
        <?php require_once '../components/sidebar.php'; ?>

        <main class="main-content p-4 w-100">
            <h2 class="mb-4">Resumen General</h2>
            <p class="text-muted">Bienvenido a tu panel de flujo de caja digital. Aquí podrás gestionar tus ingresos, gastos y visualizar tu situación financiera.</p>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">Total Ingresos</h5>
                            <p class="card-text fs-4">₡125.000</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card border-danger">
                        <div class="card-body">
                            <h5 class="card-title text-danger">Total Gastos</h5>
                            <p class="card-text fs-4">₡5.000</p>
                        </div>
                    </div>
                </div>
            </div>

<div class="mt-5">
    <h4 class="mb-3">Tipo de Cambio</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-success shadow-sm p-3 text-center">
                <div class="fs-1">⇩</div>
                <h5 class="fw-bold text-success">Compra</h5>
                <p class="fs-3">₡495</p>
                <small class="text-muted">21 ago 2025 • Ventanilla</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-danger shadow-sm p-3 text-center">
                <div class="fs-1">⇧</div>
                <h5 class="fw-bold text-danger">Venta</h5>
                <p class="fs-3">₡509</p>
                <small class="text-muted">21 ago 2025 • Ventanilla</small>
            </div>
        </div>
    </div>

    <div class="card mt-4 p-3 bg-light">
        <h6>Referencia BCCR</h6>
        <p class="mb-1">Compra: ₡501.85 • Venta: ₡507.08</p>
        <small class="text-muted">Fuente oficial – Banco Central de Costa Rica</small>
    </div>
</div>


            </div>
        </main>

    </div>
</body>
</html>