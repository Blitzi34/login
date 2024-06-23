
$(document).ready(function() {

    let queryString = window.location.search;
    let urlParams   = new URLSearchParams(queryString);
    let template    = urlParams.get('template');

    $.ajax({
        url:      '/modules/navigation.php',
        type:     'post',
        dataType: 'json',
        data: {'template': template, 'funktion': 'check_template_exists'},
        success: function(response) {

            if (response == false) {
                window.location.href = '?template=home';
            }
        },
        error: function (xhr, thrownError) {
            alert(xhr.status+'-'+thrownError);
        }
    });




    $("#logout_button").click(function(event) {
        event.preventDefault();

        $.ajax({
            url:      '/modules/navigation.php',
            type:     'post',
            dataType: 'json',
            data: {'funktion': 'logout'},
            success: function(response) {

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