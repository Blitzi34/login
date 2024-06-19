
$(document).ready(function() {

    $("#profil_speichern").click(function(event) {
        event.preventDefault();

        let profil_email    = $('#profil_email').val();
        let profil_passwort = $('#profil_passwort').val();
        let funktion        = $(this).attr('funktion');

        $.ajax({
            url:      '/modules/profil.php',
            type:     'post',
            // dataType: 'json',
            data: 
            {
                'profil_email':    profil_email, 
                'profil_passwort': profil_passwort,
                'funktion':        funktion
            },
            success: function(response) {

                if (response !== false) {
                    window.location.href = '/?template=profil';
                }
            },
            error: function (xhr, thrownError) {
                alert(xhr.status+'-'+thrownError);
            }
        });


    });



});