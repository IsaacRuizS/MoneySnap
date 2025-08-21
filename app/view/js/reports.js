$(function () {

    // Cargar transacciones desde el backend
    $.ajax({
        url: '../views/router.php?action=getTransactions',
        method: 'GET',
        dataType: 'json',
        success: function (res) {

            if (res.status === 'success') {

                const transactions = res.data || [];
                renderIncomeExpense(transactions);
                renderSavingsByMonth(transactions);

            } else {

                console.error(res.message || "No se pudieron obtener las transacciones");
            }
        },
        error: function () {
            console.error("Error de conexión al cargar las transacciones");
        }
    });

    function renderIncomeExpense(transactions) {
        let totalIncome = 0;
        let totalExpense = 0;

        transactions.forEach(t => {
            const amount = parseFloat(t.AMOUNT) || 0;
            const catId = parseInt(t.TRANSACTION_CATEGORY_ID);
            if (catId === 5) {           // ingresos
                totalIncome += amount;
            } else if (catId === 4) {    // gastos
                totalExpense += amount;
            }
        });

        const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Ingresos', 'Gastos'],
                datasets: [{
                    label: 'Ingresos vs Gastos',
                    data: [totalIncome, totalExpense],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',  // azul ingresos
                        'rgba(255, 99, 132, 0.7)'   // rojo gastos
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `₡${Number(context.raw || 0).toFixed(2)}`;
                            }
                        }
                    }
                }
            }
        });
    }

    function renderSavingsByMonth(transactions) {
        const savingsCatId = 3;

        // Construir rango de últimos 6 meses (incluye el mes actual)
        const months = buildLastMonths(6); // [{key:'YYYY-MM', label:'<mes> <año>'}, ...]
        const sumsByMonthKey = {};
        months.forEach(m => sumsByMonthKey[m.key] = 0);

        // Sumar montos de savings por mes usando CREATED_AT
        transactions.forEach(t => {
            const catId = parseInt(t.TRANSACTION_CATEGORY_ID);
            if (catId !== savingsCatId) return;

            const amount = parseFloat(t.AMOUNT) || 0;
            const createdAt = t.CREATED_AT ? new Date(t.CREATED_AT) : null;
            if (!createdAt || isNaN(createdAt)) return;

            const key = `${createdAt.getFullYear()}-${String(createdAt.getMonth() + 1).padStart(2, '0')}`;
            if (key in sumsByMonthKey) {
                sumsByMonthKey[key] += amount;
            }
        });

        // Preparar datos ordenados por los meses definidos
        const labels = months.map(m => capitalizeFirst(m.label));
        const data = months.map(m => Number(sumsByMonthKey[m.key] || 0));

        const ctx = document.getElementById('savingsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Ahorro (₡)',
                    data,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { display: true, position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `₡${Number(context.raw || 0).toFixed(2)}`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Helpers
    function buildLastMonths(n) {
        const out = [];
        const now = new Date();
        // Empezamos en el mes actual y vamos hacia atrás
        for (let i = n - 1; i >= 0; i--) {
            const d = new Date(now.getFullYear(), now.getMonth() - i, 1);
            const key = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}`;
            const label = d.toLocaleDateString('es-ES', { month: 'long', year: 'numeric' });
            out.push({ key, label });
        }
        return out;
    }

    function capitalizeFirst(str) {
        if (!str) return str;
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
