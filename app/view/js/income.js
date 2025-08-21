$(function () {

    const alertBox = $('#alert');

    // Mostrar mensajes
    function showAlert(message, type = 'success') {

        alertBox
            .removeClass('d-none alert-success alert-danger')
            .addClass(`alert alert-${type}`)
            .text(message);

        setTimeout(() => {

            alertBox.fadeOut(400, function () {

                $(this).addClass('d-none').show().text('');
            });
        }, 3000);
    }

    // POST: Registrar ingreso
    $('#incomeForm').submit(function (e) {

        e.preventDefault();

        const amount = parseFloat($('#amount').val());
        const category = $('#category').val().trim();
        const date = $('#date').val();
        const description = $('#description').val().trim();

        if (isNaN(amount) || amount <= 0) {

            showAlert('Por favor, introduce un monto válido y positivo', 'danger');
            return;
        }
        if (!category) {

            showAlert('Por favor, introduce una categoría', 'danger');
            return;
        }
        if (!date) {

            showAlert('Por favor, selecciona una fecha', 'danger');
            return;
        }

        $.ajax({
            url: '../views/router.php?action=addIncome',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {

                if (res.status === 'success') {

                    showAlert('Ingreso agregado con éxito', 'success');
                    $('#incomeForm')[0].reset();
                    $('#date').val(new Date().toISOString().split('T')[0]);
                } else {

                    showAlert(res.message || 'Error al registrar el ingreso', 'danger');
                }
            },
            error: function () {

                showAlert('Error de conexión al registrar el ingreso', 'danger');
            }
        });
    });

    // Botón limpiar
    $('#clearFormBtn').click(function () {
        
        $('#incomeForm')[0].reset();
        $('#date').val(new Date().toISOString().split('T')[0]);
    });

    // Establecer fecha actual al iniciar
    $('#date').val(new Date().toISOString().split('T')[0]);
});
