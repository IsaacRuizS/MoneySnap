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
    <?php require_once '../components/sidebar.php'; ?>

    <main class="main-content p-4 w-100">
      <h2 class="mb-4">Ahorros</h2>
      
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Mis Sobres de Ahorro</h4>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSavingsModal">
          Agregar Sobre de Ahorro
        </button>
      </div>

      <div class="row" id="savingsContainer">
        <div class="col-md-4 mb-4">
          <div class="card savings-card shadow-sm" onclick="abrirModalAhorros('Vacaciones', 150000)">
            <div class="card-body text-center">
              <div class="pig-icon mb-3">🐷</div>
              <h5 class="card-title">Vacaciones</h5>
              <p class="card-text fs-4 text-success">&#8353; 150,000</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card savings-card shadow-sm" onclick="abrirModalAhorros('Emergencias', 250000)">
            <div class="card-body text-center">
              <div class="pig-icon mb-3">🐷</div>
              <h5 class="card-title">Emergencias</h5>
              <p class="card-text fs-4 text-success">&#8353; 250,000</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card savings-card shadow-sm" onclick="abrirModalAhorros('Carro Nuevo', 500000)">
            <div class="card-body text-center">
              <div class="pig-icon mb-3">🐷</div>
              <h5 class="card-title">Carro Nuevo</h5>
              <p class="card-text fs-4 text-success">&#8353; 500,000</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para agregar sobre de ahorro -->
      <div class="modal fade" id="addSavingsModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar Sobre de Ahorro</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="addSavingsForm">
                <div class="mb-3">
                  <label for="savingsName" class="form-label">Nombre del Sobre</label>
                  <input type="text" class="form-control" id="savingsName" required>
                </div>
                <div class="mb-3">
                  <label for="savingsAmount" class="form-label">Monto Inicial (&#8353;)</label>
                  <input type="number" class="form-control" id="savingsAmount" min="0" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Agregar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para gestionar sobre de ahorro -->
      <div class="modal fade" id="manageSavingsModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="manageSavingsTitle">Gestionar Sobre</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="text-center mb-4">
                <div class="pig-icon mb-2">🐷</div>
                <h4 id="currentSavingsName">Nombre del Sobre</h4>
                <h3 class="text-success" id="currentSavingsAmount">&#8353; 0</h3>
              </div>
              
              <div class="mb-3">
                <label for="editSavingsName" class="form-label">Nombre del Sobre</label>
                <input type="text" class="form-control" id="editSavingsName">
              </div>

              <div class="row mb-3">
                <div class="col-6">
                  <label for="addAmount" class="form-label">Agregar Dinero (&#8353;)</label>
                  <input type="number" class="form-control" id="addAmount" min="1">
                </div>
                <div class="col-6">
                  <label for="withdrawAmount" class="form-label">Sacar Dinero (&#8353;)</label>
                  <input type="number" class="form-control" id="withdrawAmount" min="1">
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <button type="button" class="btn btn-primary w-100">Editar</button>
                </div>
                <div class="col-4">
                  <button type="button" class="btn btn-success w-100">Agregar</button>
                </div>
                <div class="col-4">
                  <button type="button" class="btn btn-warning w-100">Sacar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </main>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>

    function abrirModalAhorros(name, amount) {
      document.getElementById('manageSavingsTitle').textContent = 'Gestionar ' + name;
      document.getElementById('currentSavingsName').textContent = name;
      document.getElementById('currentSavingsAmount').textContent = '₡ ' + amount.toLocaleString();
      document.getElementById('editSavingsName').value = name;
      
      const modal = new bootstrap.Modal(document.getElementById('manageSavingsModal'));
      modal.show();
    }

  </script>

  </body>
</html>