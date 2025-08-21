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
        <script src="../js/transactions.js"></script>
        <title>MoneySnap - Historial de Transacciones</title>
    </head>
    <body>
        <?php require_once '../components/header_common.php'; ?>

        <div class="d-flex">
            <?php require_once '../components/sidebar.php'; ?>

            <main class="main-content p-4 w-100">
                <h2 class="mb-4">Historial de Transacciones</h2>
                <p class="text-muted">Aquí puedes ver un resumen de todos tus ingresos y gastos.</p>

                <!-- Resumen de balance -->
                <div class="balance-summary mb-4">
                    <h2 class="text-xl font-semibold">Saldo Actual</h2>
                    <p id="currentBalance" class="fs-1 fw-bold text-primary mt-2">₡0.00</p>
                    <div class="d-flex justify-content-around mt-3">
                        <div>
                            <span class="fs-5 fw-medium">Ingresos: </span>
                            <span id="totalIncome" class="fs-5 fw-bold income-total">₡0.00</span>
                        </div>
                        <div>
                            <span class="fs-5 fw-medium">Gastos: </span>
                            <span id="totalExpense" class="fs-5 fw-bold expense-total">₡0.00</span>
                        </div>
                    </div>
                </div>

                <!-- Lista de transacciones -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Transacciones Recientes</h5>
                    </div>
                    <div class="card-body p-0">
                        <div id="transactionsContainer" class="list-group list-group-flush">
                            <p class="text-center text-muted p-4" id="noTransactionsMessage">
                                No hay transacciones registradas aún.
                            </p>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Modal de mensajes -->
        <div id="messageModal" class="modal-custom">
            <div class="modal-content-custom">
                <span class="close-button-custom">&times;</span>
                <p id="modalMessage" class="fs-5 mb-4"></p>
                <button id="modalCloseBtn" class="btn btn-money">Aceptar</button>
            </div>
        </div>
    </body>
</html>
