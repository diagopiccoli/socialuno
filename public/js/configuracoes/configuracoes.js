function saveDadosConfiguracoes()
{

	nome_usuario = $.trim($('#nome_usuario').val());
	sobrenome_usuario = $.trim($('#sobrenome_usuario').val());
	sexo = $('#sexo').val();

	if(nome_usuario == '' || sobrenome_usuario == ''){
		alert('campos com * sao obrigatorios');
		return;
	}
	data = {};
	$('.form-box > input').each(function(){
		data[this.id] = this.value;
	});
	data['id'] = $('#id_user').val();
	data['sexo'] = sexo;

	$.post(
            '/social-uno/configuracoes/save',
            {
                data: data,
            },
            function (data, status) {

            	if(data){
            		alert('Salvo');
            		window.location.reload();
            		return;
            	}

            	alert('Erro');
               

            },
        'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );

}

$(document).ready(function() {
	marcaMenu('#li-configuracoes');
});