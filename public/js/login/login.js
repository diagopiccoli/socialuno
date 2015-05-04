$('.div-form-login > div > input').keypress(function (event) {
    if (event.which == 13) {
        $('#logar').click();
        return;
    }
});



$('#facebook_dados').blur(function () {
    $(this).css('border', '');
    if ($.trim($(this).val()) == '') {
        $(this).css('border', '1px solid red');
        return;
    }

    $.getJSON("//graph.facebook.com/"+$(this).val()+"?fields=name,username,picture,gender", function (dados) {

        if(dados.error){
            return;
        }
        $('#id_facebook').val(dados.id);
        $('#nome_cadastro').val(dados.name);
            if(dados.gender == 'male'){
            $('#genero').val('M');
        }else{
             $('#genero').val('F');
        }   
        
       $('.img-facebook').html('<img src="'+dados.picture.data.url+'">');   
       
    });



});

$('.div-form-cadastro > div > input ').blur(function () {
    $(this).removeAttr('style');

    if ($.trim($(this).val()) == '') {

        $(this).css('border', '1px solid #ff0000');
        return;
    }

    if ($(this).attr('id') == 'novo_usuario_senha_confirmar') {

        if ($.trim($(this).val()) !== $.trim($('#novo_usuario_senha').val())) {
            alert('senhas nao correspondem');
            $('#cadastrar').removeAttr('onclick');
        } else {
            $('#cadastrar').attr('onclick', 'cadastrar(this)');
        }
    }

});

function cadastrar(obj)
{
    var condicao = false;
    $('.div-form-cadastro > div > input ').each(function () {
        if ($.trim(this.value) == '' && $(this).attr('id') != 'id_facebook') {
            alert('campos nulos');
            condicao = true;
            return false;
        }
    });

    if (condicao) {
        return;
    }

    dataUrl = $(obj).attr('data-url');
    data = {
        'login': $('#email').val(),
        'senha': $('#novo_usuario_senha').val(),
        'nome': $('#nome_cadastro').val(),
        'data_nascimento': $('#data_nascimento').val(),
        'genero': $('#genero').val(),
        'id_facebook' : $('#id_facebook').val(),
    };

    if ($.trim(login) == '') {
        alert('cara preenche um email');
        return;
    }

    if ($('#genero').val() == 0) {
        $('#genero').focus();
        alert('genero');
        return;
    }

    $.post(
            dataUrl,
            {
                data: data,
            },
            function (data, status) {

                if (data.result == false) {

                    if (data.type == 'email') {
                        respostaError('#email', 'Email cadastrado não é valido');
                        return;
                    }

                    if (data.type == 'caracterSenha') {
                        respostaError('#novo_usuario_senha', 'A senha não pode ser inferior a 3 caracteres');
                        return;
                    }

                    if (data.type == 'emailTrue') {
                        respostaError('#email', 'Esse e-mail já foi cadastrado');
                        return;
                    }
                }
                
                window.location.href = '/social-uno/index/index';
                return;

            },
            'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
            );

}

function  respostaError(div, msgError)
{
    $('.form-box > ' + div).parent().append('<div id="resp"> ' + msgError + '</div>');
    $(div).focus();
    setTimeout(function () {
        $('#resp').remove();
    }, 5000);
}


function logar(obj)
{
    var dataUrl = $(obj).attr('data-url');
    var login = $('#login').val();
    var senha = $('#senha').val();

    if ($.trim($('#login').val()) == '' || $.trim($('#senha').val()) == '') {
        alert('preencher campos');
        return;
    }

    $.post(
            dataUrl,
            {
                login: login,
                senha: senha,
            },
            function (data, status) {

                if (data) {
                    window.location.href = '/social-uno/index/index';
                    return;
                }

                alert('erro a senha');

            },
            'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}

