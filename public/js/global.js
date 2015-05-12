$(document).ready(function() {
    $('[data-mask]').each(function() {
        $(this).mask($(this).attr('data-mask'));
    });
    $('[data-toggle="tooltip"]').tooltip();
});


function logout()
{
    
    $.post(
        '/social-uno/index/logout',
        function (data, status) {
                console.log(data);
             window.location.href = '/social-uno/login/index';
        },

    'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}