$(document).ready(function() {
	marcaMenu('#li-notificacoes');
});


function recusarAmigo(id_amigo)
{

    $('.nome-usuario').html('<span class="fa fa-refresh"></span>');
    $.post(
            '/social-uno/notificacoes/cancelar',
            {
                data: id_amigo,
            },
            function (data, status) {
                    
                    if(data){
                        $('#usuario_'+id_amigo).html('');
                        window.location.reload();
                    }   
            
            },
        'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}

function adicionarAmigo(id_amigo)
{
	$('.nome-usuario').html('<span class="fa fa-refresh"></span>');
    $.post(
            '/social-uno/notificacoes/aceitar',
            {
                data: id_amigo,
            },
            function (data, status) {
                    
                    if(data){
                        $('.nome-usuario').html('Solicitação de amizade aceita!');
                        window.location.reload();
                    }   
            },
        'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );

}