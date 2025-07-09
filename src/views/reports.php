<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once '../components/head_common.php'; ?>
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php require_once '../components/header_common.php'; ?>

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
                
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Gastos por Categoría</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="expenseCategoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Resumen Mensual</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <h4 class="text-success">₡15,750</h4>
                                    <p class="text-muted">Total Ingresos</p>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="text-danger">₡12,340</h4>
                                    <p class="text-muted">Total Gastos</p>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="text-primary">₡3,410</h4>
                                    <p class="text-muted">Balance</p>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="text-info">78%</h4>
                                    <p class="text-muted">Tasa de Ahorro</p>
                                </div>
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