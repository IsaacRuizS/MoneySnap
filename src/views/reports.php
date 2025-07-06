<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/png" href="../assets/MoneySnapLogo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<header class="navbar navbar-expand-lg navbar-dark bg-money p-2 shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../assets/MoneySnapLogo.png" alt="MoneySnap Logo" style="height: 60px; border-radius: 10px;">
    </a>
    <div class="d-flex">
      <a href="login.php" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
    </div>
  </div>
</header>

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