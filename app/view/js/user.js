$(function () {

    const alertBox = $('#alert');

    //mostrar mensajes
    function showAlert(message, type = 'success') {
        alertBox
            .removeClass('d-none alert-success alert-danger')
            .addClass(`alert alert-${type}`)
            .text(message);
    }

    // GET: Cargar datos del usuario
    function loadUserData() {

        $.ajax({
            url: '../views/router.php?action=getUser',
            method: 'GET',
            dataType: 'json',
            success: function (res) {

                if (res.status === 'success' && res.data) {

                    $('#name').val(res.data.NAME);
                    $('#lastName').val(res.data.LAST_NAME);
                    $('#email').val(res.data.EMAIL);

                } else {

                    showAlert(res.message || 'No se pudo cargar la información del usuario', 'danger');
                }

            },
            error: function () {

                showAlert('Error de conexión al obtener la información del usuario', 'danger');
            }
        });
    }

    // POST: Actualizar datos del usuario
    $('#userForm').submit(function (e) {

        e.preventDefault();

        const name = $('#name').val().trim();
        const lastName = $('#lastName').val().trim();
        const email = $('#email').val().trim();

        if (!name || !lastName || !email) {
            
            showAlert('Por favor, complete todos los campos obligatorios', 'danger');
            return;
        }

        $.ajax({
            url: '../views/router.php?action=updateUser',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {

                if (res.status === 'success') {

                    showAlert('Datos actualizados correctamente', 'success');
                    $('#password').val(''); // limpiar campo password

                    setTimeout(() => {
                        alertBox.fadeOut(400, function () {
                            $(this).addClass('d-none').show().text(''); // reset estado
                        });
                    }, 3000);

                } else {

                    showAlert(res.message || 'Error al actualizar los datos', 'danger');
                }

            },
            error: function () {

                showAlert('Error de conexión al actualizar los datos', 'danger');
            }
        });
    });

    // Cargar datos al iniciar
    loadUserData();
});
