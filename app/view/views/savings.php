<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
    
    require_once '../../controller/SavingsController.php';
    $savingsController = new SavingsController();
    $response = $savingsController->getUserSavings();
    $userSavings = $response['data'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once '../components/head_common.php'; ?>
    <title>Ahorros</title>
</head>

<body>
    <?php require_once '../components/header_common.php'; ?>

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
                <?php if (empty($userSavings)): ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <h5>No tienes sobres de ahorro aún</h5>
                            <p>Comienza creando tu primer sobre de ahorro para organizar tus metas financieras.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($userSavings as $saving): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card savings-card shadow-sm" onclick="abrirModalAhorros(<?php echo $saving['TRANSACTION_ID']; ?>, '<?php echo htmlspecialchars($saving['DESCRIPTION']); ?>', <?php echo $saving['AMOUNT']; ?>)">
                                <div class="card-body text-center">
                                    <div class="pig-icon mb-3">🐷</div>
                                    <h5 class="card-title"><?php echo htmlspecialchars($saving['DESCRIPTION']); ?></h5>
                                    <p class="card-text fs-4 text-success">&#8353; <?php echo number_format($saving['AMOUNT'], 0, ',', '.'); ?></p>
                                    <small class="text-muted">Creado: <?php echo date('d/m/Y', strtotime($saving['CREATED_AT'])); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
                            <form id="addSavingsForm" method="POST" action="../../controller/savingsHandler.php">
                                <input type="hidden" name="action" value="createSavings">
                                <div class="mb-3">
                                    <label for="savingsName" class="form-label">Nombre del Sobre</label>
                                    <input type="text" class="form-control" id="savingsName" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="savingsAmount" class="form-label">Monto Inicial (&#8353;)</label>
                                    <input type="number" class="form-control" id="savingsAmount" name="amount" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="savingsDeadline" class="form-label">Fecha Meta (Opcional)</label>
                                    <input type="date" class="form-control" id="savingsDeadline" name="deadline">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" form="addSavingsForm" class="btn btn-primary">Agregar</button>
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
                            <input type="hidden" id="currentSavingsId">
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
                                    <input type="number" class="form-control" id="subtractAmount" min="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary w-100" onclick="updateSavings()">Editar</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-success w-100" onclick="addMoneyToSavings()">Agregar</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-warning w-100" onclick="subtractMoneyToSavings()">Sacar</button>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <button type="button" class="btn btn-danger w-100" onclick="deleteSavings()">Eliminar Sobre</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function abrirModalAhorros(id, name, amount) {
            document.getElementById('currentSavingsId').value = id;
            document.getElementById('manageSavingsTitle').textContent = 'Gestionar ' + name;
            document.getElementById('currentSavingsName').textContent = name;
            document.getElementById('currentSavingsAmount').textContent = '₡ ' + amount.toLocaleString();
            document.getElementById('editSavingsName').value = name;
            
            const modal = new bootstrap.Modal(document.getElementById('manageSavingsModal'));
            modal.show();
        }
        
        function updateSavings() {
            const id = document.getElementById('currentSavingsId').value;
            const name = document.getElementById('editSavingsName').value;
            
            if (!name) {
                alert('Por favor ingresa un nombre válido');
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'updateSavings');
            formData.append('id', id);
            formData.append('name', name);
            
            fetch('../../controller/savingsHandler.php', {
                method: 'POST',
                body: formData
            })

            location.reload();
        }
        
        function addMoneyToSavings() {
            const id = document.getElementById('currentSavingsId').value;
            const amount = parseFloat(document.getElementById('addAmount').value);
            
            if (!amount || amount <= 0) {
                alert('Por favor ingresa un monto válido');
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'addMoney');
            formData.append('id', id);
            formData.append('amount', amount);
            
            fetch('../../controller/savingsHandler.php', {
                method: 'POST',
                body: formData
            })

            location.reload();
        }
        
        
        function subtractMoneyToSavings() {
            const id = document.getElementById('currentSavingsId').value;
            const amount = parseFloat(document.getElementById('subtractAmount').value);
            
            if (!amount || amount <= 0) {
                alert('Por favor ingresa un monto válido');
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'subtractMoney');
            formData.append('id', id);
            formData.append('amount', amount);
            
            fetch('../../controller/savingsHandler.php', {
                method: 'POST',
                body: formData
            })

            location.reload();
        }

        function deleteSavings() {
            if (!confirm('¿Estás seguro de que quieres eliminar este sobre de ahorro? Esta acción no se puede deshacer.')) {
                return;
            }
            
            const id = document.getElementById('currentSavingsId').value;
            
            const formData = new FormData();
            formData.append('action', 'deleteSavings');
            formData.append('id', id);
            
            fetch('../../controller/savingsHandler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.json();
                }
            })
            .then(data => {
                if (data && data.status === 'success') {
                    location.reload();
                } else if (data) {
                    alert('Error al eliminar: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar el sobre');
            });
        }
    </script>

</body>
</html>