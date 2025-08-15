$(function () {

    $('#registerForm').submit(function (e) {
        
        e.preventDefault();

        const name = $('#name').val().trim();
        const lastName = $('#lastName').val().trim();
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();
        const alertBox = $('#alert').removeClass('d-none alert-danger alert-success');

        // Validar campos vacíos
        if (!name || !lastName || !email || !password) {
            alertBox.addClass('alert alert-danger').text('Por favor, complete todos los campos.');
            return;
        }

        $.ajax({
            url: '../views/router.php?action=register',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {

                alertBox.removeClass('alert-danger alert-success');

                if (response.status === 'success') {
                    
                    alertBox.addClass('alert alert-success').text('Registro exitoso.');
                    window.location.href = 'login.php';

                } else {

                    alertBox.addClass('alert alert-danger').text(response.message || 'Error en el registro');
                }
            },
            error: function (e) {
                alertBox
                    .removeClass('alert-success')
                    .addClass('alert alert-danger')
                    .text('Error de conexión con el servidor : ', e);
            }
        });
    });
});
