<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    require_once '../../controller/ReportsController.php';
    $reportsController = new ReportsController();
    $response = $reportsController->getTransactions();
    $transactions = $response['data'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once '../components/head_common.php'; ?>
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php require_once '../components/header_common.php'; ?>

    <div style="display: none;" id="expensesInfo"><?php echo $transactions ?></div>

    <div class="d-flex">
        <?php require_once '../components/sidebar.php'; ?>

        <main class="main-content p-4 w-100">
            <h2 class="mb-4">Reportes Financieros</h2>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ingresos vs Gastos</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="incomeExpenseChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>

    </div>

    <script src="../js/reports.js"></script>

</body>
</html>