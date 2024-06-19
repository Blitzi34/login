
$(document).ready(function() {

    let queryString = window.location.search;
    let urlParams   = new URLSearchParams(queryString);
    let template    = urlParams.get('template');

    $('.active').removeClass('active');
    if(template.length > 0 && $('#'+template)) {
        $('#'+template).addClass('active');
    }


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