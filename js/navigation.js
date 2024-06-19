
$(document).ready(function() {

    $("#logout_button").click(function(event) {
        event.preventDefault();

        $.ajax({
            url:      '/modules/navigation.php',
            type:     'post',
            // dataType: 'json',
            data: {'funktion': 'logout'},
            success: function(response) {

                console.log(response);

                if (response !== false) {
                    window.location.href = '?template=home';
                }

            },
            error: function (xhr, thrownError) {
                alert(xhr.status+'-'+thrownError);
            }
        });


    });



});