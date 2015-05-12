$(document).ready(function () {
    $('[data-mask]').each(function () {
        $(this).mask($(this).attr('data-mask'));
    });
    $('[data-toggle="tooltip"]').tooltip();

    ajaxBuscaUsuarios();

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

function ajaxBuscaUsuarios()
{
    var timer;
    
    $('#find_friends').keyup(function () {

        value = this.value;
        if ($.trim(value) == '') {
            closeDivBusca();
            return;
        }
        
        clearTimeout(timer);
        
        $('.div-colum-destaque').append('<i class="fa fa-refresh fa-spin fa-lg icon-busca"></i>');

        data = {
            'busca': value
        };
        
        timer = setTimeout(function () {

            $.post(
                    '/social-uno/index/ajax-busca-usuarios',
                    {
                        data: data
                    },
                    function (data, status) {

                        $('.resposta-busca-usuarios').removeClass('hide');
                        $('.resposta-busca-usuarios').html(data);
                        $('.icon-busca').remove();
                        
                    }
               //'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
            );

        }, 1000);


    });

}

function closeDivBusca()
{
    $('.resposta-busca-usuarios').addClass('hide');
    $('.resposta-busca-usuarios').html('');
}