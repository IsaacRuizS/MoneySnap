<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once '../components/head_common.php'; ?>
    <title>MoneySnap - Historial de Transacciones</title>
</head>
<body>
    <?php require_once '../components/header_common.php'; ?>

    <div class="d-flex">
        <?php require_once '../components/sidebar.php'; ?>

        <main class="main-content p-4 w-100">
            <h2 class="mb-4">Historial de Transacciones</h2>
            <p class="text-muted">Aquí puedes ver un resumen de todos tus ingresos y gastos.</p>

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

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Transacciones Recientes</h5>
                </div>
                <div class="card-body p-0">
                    <div id="transactionsContainer" class="list-group list-group-flush">
                        <p class="text-center text-muted p-4" id="noTransactionsMessage">No hay transacciones registradas aún.</p>
                    </div>
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
        const transactionsContainer = document.getElementById('transactionsContainer');
        const currentBalanceSpan = document.getElementById('currentBalance');
        const totalIncomeSpan = document.getElementById('totalIncome');
        const totalExpenseSpan = document.getElementById('totalExpense');
        const noTransactionsMessage = document.getElementById('noTransactionsMessage');

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

        function loadTransactions() {
            let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
            
            const activeTransactions = transactions.filter(t => t.deleted_at === null);

            let totalIncome = 0;
            let totalExpense = 0;

            activeTransactions.forEach((t) => {
                const amount = parseFloat(t.amount);
                if (t.type === 'income') {
                    totalIncome += amount;
                } else if (t.type === 'expense') {
                    totalExpense += amount;
                }
            });

            activeTransactions.sort((a, b) => {
                const dateA = new Date(a.date);
                const dateB = new Date(b.date);
                return dateB - dateA;
            });

            displayTransactions(activeTransactions);
            updateBalanceSummary(totalIncome, totalExpense, totalIncome - totalExpense);
        }

        function displayTransactions(transactions) {
            transactionsContainer.innerHTML = '';
            if (transactions.length === 0) {
                noTransactionsMessage.style.display = 'block';
            } else {
                noTransactionsMessage.style.display = 'none';
                transactions.forEach(transaction => {
                    const transactionItem = document.createElement('div');
                    transactionItem.className = `list-group-item d-flex justify-content-between align-items-center ${transaction.type === 'income' ? 'income' : 'expense'}`;
                    transactionItem.innerHTML = `
                        <div class="flex-grow-1">
                            <h6 class="mb-1">${transaction.category} - ${transaction.description || 'Sin descripción'}</h6>
                            <small class="text-muted">${new Date(transaction.date).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })}</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="fs-5 fw-bold me-3">${transaction.type === 'income' ? '+' : '-'}₡${parseFloat(transaction.amount).toFixed(2)}</span>
                            <button data-id="${transaction.id}" class="delete-btn btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    transactionsContainer.appendChild(transactionItem);
                });

                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', handleDeleteTransaction);
                });
            }
        }

        function updateBalanceSummary(income, expense, balance) {
            totalIncomeSpan.textContent = `₡${income.toFixed(2)}`;
            totalExpenseSpan.textContent = `₡${expense.toFixed(2)}`;
            currentBalanceSpan.textContent = `₡${balance.toFixed(2)}`;
            currentBalanceSpan.className = `fs-1 fw-bold mt-2 ${balance >= 0 ? 'text-success' : 'text-danger'}`;
        }

        function handleDeleteTransaction(e) {
            const transactionId = e.currentTarget.dataset.id;
            if (!transactionId) {
                showModal("Error: No se pudo identificar la transacción para eliminar.");
                return;
            }

            let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
            const initialLength = transactions.length;
            transactions = transactions.filter(t => t.id !== transactionId);
            
            if (transactions.length < initialLength) {
                localStorage.setItem('transactions', JSON.stringify(transactions));
                showModal("Transacción eliminada con éxito!");
                loadTransactions();
            } else {
                showModal("Error: No se encontró la transacción para eliminar.");
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadTransactions();
        });
    </script>
</body>
</html>