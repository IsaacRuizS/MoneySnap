$(function () {

    const transactionsContainer = $('#transactionsContainer');
    const currentBalanceSpan = $('#currentBalance');
    const totalIncomeSpan = $('#totalIncome');
    const totalExpenseSpan = $('#totalExpense');
    const noTransactionsMessage = $('#noTransactionsMessage');

    const messageModal = $('#messageModal');
    const modalMessage = $('#modalMessage');
    const modalCloseBtn = $('#modalCloseBtn');
    const closeButton = $('.close-button-custom');

    // Mostrar mensajes en modal
    function showModal(message) {
        if (messageModal && modalMessage) {
            modalMessage.text(message);
            modalMessage.css('color', '#333');
            messageModal.css('display', 'flex');
        }
    }

    if (modalCloseBtn.length) {
        modalCloseBtn.on('click', () => messageModal.hide());
    }
    if (closeButton.length) {
        closeButton.on('click', () => messageModal.hide());
    }
    $(window).on('click', (e) => {
        if (e.target === messageModal[0]) {
            messageModal.hide();
        }
    });

    // GET: cargar transacciones
    function loadTransactions() {
        $.ajax({
            url: '../views/router.php?action=getTransactions',
            method: 'GET',
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    const transactions = res.data;

                    let totalIncome = 0;
                    let totalExpense = 0;

                    transactions.forEach(t => {
                        const amount = parseFloat(t.AMOUNT);
                        if (parseInt(t.TRANSACTION_CATEGORY_ID) === 5) {
                            totalIncome += amount;
                        } else if (parseInt(t.TRANSACTION_CATEGORY_ID) === 4) {
                            totalExpense += amount;
                        }
                    });

                    displayTransactions(transactions);
                    updateBalanceSummary(totalIncome, totalExpense, totalIncome - totalExpense);

                } else {
                    showModal(res.message || "No se pudieron obtener las transacciones");
                }
            },
            error: function () {
                showModal("Error de conexión al cargar las transacciones");
            }
        });
    }

    // Renderizar lista de transacciones
    function displayTransactions(transactions) {
        transactionsContainer.empty();

        if (!transactions || transactions.length === 0) {
            noTransactionsMessage.show();
        } else {
            noTransactionsMessage.hide();

            transactions.forEach(t => {
                const typeClass = t.TYPE === 'income' ? 'income' : 'expense';
                const date = new Date(t.CREATED_AT);

                const transactionItem = $(`
                    <div class="list-group-item d-flex justify-content-between align-items-center ${typeClass}">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">${t.CATEGORY || ''} - ${t.DESCRIPTION || 'Sin descripción'}</h6>
                            <small class="text-muted">${date.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })}</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="fs-5 fw-bold me-3">${parseInt(t.TRANSACTION_CATEGORY_ID) === 5 ? '+' : parseInt(t.TRANSACTION_CATEGORY_ID) === 4 ? '-' : ''}₡${parseFloat(t.AMOUNT).toFixed(2)}</span>
                        </div>
                    </div>
                `);

                transactionsContainer.append(transactionItem);
            });
        }
    }

    // Actualizar resumen de saldo
    function updateBalanceSummary(income, expense, balance) {
        totalIncomeSpan.text(`₡${income.toFixed(2)}`);
        totalExpenseSpan.text(`₡${expense.toFixed(2)}`);
        currentBalanceSpan.text(`₡${balance.toFixed(2)}`);
        currentBalanceSpan.attr('class', `fs-1 fw-bold mt-2 ${balance >= 0 ? 'text-success' : 'text-danger'}`);
    }

    // Al cargar la página
    loadTransactions();
});
