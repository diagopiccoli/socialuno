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
        clearTimeout(timer);
        if ($.trim(value) == '') {
            closeDivBusca();
            return;
        }
        
        $('.icon-busca').html('<i class="fa fa-refresh fa-spin fa-lg"></i>');

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
                        $('.icon-busca').html('');
                        
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
    $('.icon-busca').html('');
}

function redirectToProfileUser()
{
    $('.usuarios-busca').click(function(){
        
        var id_user = $(this).attr('id').split('_')[1];
        console.log(id_user);
        
        window.location.href = '/social-uno/friend-profile/index?user='+id_user;
        
    });
    
}