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

<div class="mt-5">
    <h4 id="fecha" class="mb-3">Tipo de Cambio</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-success shadow-sm p-3 text-center">
                <div class="fs-1">⇩</div>
                <h5 class="fw-bold text-success">Compra</h5>
                <p id="compra" class="fs-3">₡495</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-danger shadow-sm p-3 text-center">
                <div class="fs-1">⇧</div>
                <h5 class="fw-bold text-danger">Venta</h5>
                <p id="venta" class="fs-3">₡509</p>
            </div>
        </div>
    </div>

    <div class="card mt-4 p-3 bg-light">
        <h6>Tipo de Cambio</h6>
        <p id="tipoCambio" class="mb-1">Compra: ₡501.85 • Venta: ₡507.08</p>
    </div>
</div>


            </div>
        </main>

    </div>
    <script>
        const tipoCambio = document.getElementById('tipoCambio');
        const compra = document.getElementById('compra');
        const venta = document.getElementById('venta');
        const fecha = document.getElementById('fecha');
        const fechaActual = new Date();

        async function obtenerTipoCambio() {
            const resp = await fetch("https://tipodecambio.paginasweb.cr/api");
            const data = await resp.json();
            return data;
        }

        obtenerTipoCambio().then(data => {
            tipoCambio.innerHTML = `Compra: ${data.compra} • Venta: ${data.venta}`;
            compra.innerHTML = `₡${data.compra}`;
            venta.innerHTML = `₡${data.venta}`;

            const fechaFormateada = fechaActual.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });
            fecha.innerHTML = `Tipo de Cambio - ${fechaFormateada}`;
        });

    </script>
</body>
</html>