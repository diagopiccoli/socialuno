function adicionarAmigo()
{
	$('.mensagem-usuario-adicionar').html('<span class="fa fa-refresh"></span>');
	$.post(
            '/social-uno/friend-profile/adicionar',
            {
                data: $('#id_usuario_perfil').val(),
            },
            function (data, status) {
            		
            		if(data){
            			$('.mensagem-usuario-adicionar').html('<h4> Você enviou uma solicitação de amizade </h4>');
                        window.location.reload();
            		}	
          	
            },
        'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}

function cancelarSolicitacao()
{
	$('.mensagem-usuario-adicionar').html('<span class="fa fa-refresh"></span>');
	$.post(
            '/social-uno/friend-profile/cancelar',
            {
                data: $('#id_usuario_perfil').val(),
            },
            function (data, status) {
            		
            		if(data){
            			$('.mensagem-usuario-adicionar').html('<h4> Nao são amigos </h4>');
                        window.location.reload();
            		}	
          	
            },
        'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}

function adicionaAmigo()
{
    $('.mensagem-usuario-adicionar').html('<span class="fa fa-refresh"></span>');
    $.post(
            '/social-uno/notificacoes/aceitar',
            {
                data: $('#id_usuario_perfil').val(),
            },
            function (data, status) {
                    
                    if(data){
                       $('.mensagem-usuario-adicionar').html('Vocês são amigos');
                       window.location.reload();
                    }   
            },
        'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}



