
$(document).ready(function() {

    $("#submit_login, #submit_registrieren").click(function(event) {
        event.preventDefault();

        let email    = $('#email').val();
        let passwort = ($('#passwort').val());
        let funktion = $(this).attr('funktion');

        $.ajax({
            url: '/modules/login.php',
            type: 'post',
            dataType: 'json',
            data: {'email':    $('#email').val(), 
                   'passwort': $('#passwort').val(), 
                   'funktion': $(this).attr('funktion')
                },

            success: function(response) {
                $('#overlay').fadeOut();

                if (response !== false) {
                    alert('inserted');
                }

            }
        });


    });



});