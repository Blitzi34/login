$(document).ready(function() {

    $("#submit_login, #submit_registrieren").click(function(event) {
        event.preventDefault();

        let email    = $('#email').val();
        let passwort = ($('#passwort').val());
        let funktion = $(this).attr('funktion'); ///login oder registrieren

        $.ajax({
            url:      '/modules/login.php',
            type:     'post',
            dataType: 'json',
            data: 
            {
                'email':    email, 
                'passwort': passwort, 
                'funktion': funktion
            },
            success: function(response) {

                show_errors(response);

                if (response == true) {
                    window.location.href = '?template=home';
                }
            },
            error: function (xhr, thrownError) {
                alert(xhr.status+'-'+thrownError);
            }
        });

    });


});