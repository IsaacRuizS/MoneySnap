<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/png" href="../assets/MoneySnapLogo.png">
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
    <aside class="sidebar bg-light p-3">
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="nav-link active" href="#">📊 Inicio</a>
        </li>
         <li class="nav-item mb-2">
          <a class="nav-link" href="#">💰 Ahorros</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link" href="#">➕ Ingresos</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link" href="#">➖ Gastos</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link" href="#">💳 Transacciones</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link" href="#">📈 Reportes</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link" href="#">👥 Usuarios</a>
        </li>
      </ul>
    </aside>

    <main class="main-content p-4 w-100">
      <h2 class="mb-4">Resumen General</h2>
      <p class="text-muted">Bienvenido a tu panel de flujo de caja digital. Aquí podrás gestionar tus ingresos, gastos y visualizar tu situación financiera.</p>

      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card border-success">
            <div class="card-body">
              <h5 class="card-title text-success">Total Ingresos</h5>
              <p class="card-text fs-4">₡0.00</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <div class="card border-danger">
            <div class="card-body">
              <h5 class="card-title text-danger">Total Gastos</h5>
              <p class="card-text fs-4">₡0.00</p>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5">
      <h4 class="mb-3">Transacciones Recientes</h4>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col">Fecha</th>
              <th scope="col">Descripción</th>
              <th scope="col">Categoría</th>
              <th scope="col">Tipo</th>
              <th scope="col">Monto</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Aquí irá el codigo PHP para conexion con DB
            ?>
          </tbody>
        </table>
      </div>
    </div>
    </main>

  </div>
  </body>
</html>