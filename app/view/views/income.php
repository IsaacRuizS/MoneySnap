<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once '../components/head_common.php'; ?>
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

    <div id="messageModal" class="modal-custom">
        <div class="modal-content-custom">
            <span class="close-button-custom">&times;</span>
            <p id="modalMessage" class="fs-5 mb-4"></p>
            <button id="modalCloseBtn" class="btn btn-money">Aceptar</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const incomeForm = document.getElementById('incomeForm');
        const amountInput = document.getElementById('amount');
        const categoryInput = document.getElementById('category');
        const dateInput = document.getElementById('date');
        const descriptionInput = document.getElementById('description');
        const clearFormBtn = document.getElementById('clearFormBtn');

        const messageModal = document.getElementById('messageModal');
        const modalMessage = document.getElementById('modalMessage');
        const modalCloseBtn = document.getElementById('modalCloseBtn');
        const closeButton = document.querySelector('.close-button-custom');

        function showModal(message) {
            if (messageModal && modalMessage) {
                modalMessage.textContent = message;
                modalMessage.style.color = '#333';
                messageModal.style.display = 'flex';
            } else {
                console.error("Modal elements not found for showModal.");
            }
        }

        if (modalCloseBtn) {
            modalCloseBtn.onclick = function() {
                if (messageModal) messageModal.style.display = 'none';
            }
        }
        if (closeButton) {
            closeButton.onclick = function() {
                if (messageModal) messageModal.style.display = 'none';
            }
        }
        window.onclick = function(event) {
            if (event.target == messageModal) {
                if (messageModal) messageModal.style.display = 'none';
            }
        }

        incomeForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const amount = parseFloat(amountInput.value);
            const category = categoryInput.value.trim();
            const date = dateInput.value;
            const description = descriptionInput.value.trim();

            if (isNaN(amount) || amount <= 0) {
                showModal("Por favor, introduce un monto válido y positivo.");
                return;
            }
            if (!category) {
                showModal("Por favor, introduce una categoría.");
                return;
            }
            if (!date) {
                showModal("Por favor, selecciona una fecha.");
                return;
            }

            const newTransaction = {
                id: Date.now().toString(), // ID único basado en el timestamp
                type: 'income',
                amount,
                category,
                date,
                description,
                createdAt: new Date().toISOString(), // Fecha de creación
                deleted_at: null // Para consistencia, aunque no se use para filtrar en localStorage
            };

            let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
            transactions.push(newTransaction);
            localStorage.setItem('transactions', JSON.stringify(transactions));

            showModal("Ingreso agregado con éxito!");
            incomeForm.reset();
            dateInput.valueAsDate = new Date();
        });

        clearFormBtn.addEventListener('click', () => {
            incomeForm.reset();
            dateInput.valueAsDate = new Date();
        });

        document.addEventListener('DOMContentLoaded', () => {
            dateInput.valueAsDate = new Date();
        });
    </script>
</body>
</html>