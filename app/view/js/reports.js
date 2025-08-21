// Gráfico de Ingresos vs Gastos

let expensesAmount = document.getElementById('expensesInfo').textContent

const ctx1 = document.getElementById('incomeExpenseChart').getContext('2d');
new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Agosto'],
        datasets: [{
            label: 'Ingresos',
            data: [0, 0, 0, 0, 0, 0],
            backgroundColor: 'rgba(40, 167, 69, 0.8)',
            borderColor: 'rgba(40, 167, 69, 1)',
            borderWidth: 1
        }, {
            label: 'Gastos',
            data: [0, 0, 0, 0, 0, expensesAmount],
            backgroundColor: 'rgba(220, 53, 69, 0.8)',
            borderColor: 'rgba(220, 53, 69, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '₡' + value.toLocaleString();
                    }
                }
            }
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});