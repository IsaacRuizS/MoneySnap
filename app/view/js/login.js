$(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        const email = $('#email').val().trim();
        const password = $('#password').val().trim();
        const alertBox = $('#alert').removeClass('d-none alert-danger alert-success');

        // Validar campos vacíos
        if (!email || !password) {
            alertBox.addClass('alert alert-danger').text('Por favor, complete todos los campos.');
            return;
        }

        $.ajax({
            url: '../views/router.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {

                alertBox.removeClass('alert-danger alert-success');

                if (response.status === 'success') {
                    
                    alertBox.addClass('alert alert-success').text('Inicio de sesión correcto.');
                    window.location.href = 'home.php';

                } else {

                    alertBox.addClass('alert alert-danger').text(response.message || 'Error en el login');
                }
            }, error: function () {

                alertBox
                    .removeClass('alert-success')
                    .addClass('alert alert-danger')
                    .text('Error de conexión con el servidor');
            }
        });
    });
});
