$(document).ready(function () {
    $('[data-mask]').each(function () {
        $(this).mask($(this).attr('data-mask'));
    });
    $('[data-toggle="tooltip"]').tooltip();

    ajaxBuscaPrimitive();

});

function logout()
{

    $.post(
		'/social-uno/index/logout',
		function (data, status) {
			window.location.href = '/social-uno/login/index';
		},
		'json'
	);
}

function marcaMenu(id)
{
	$('#menu-perfil li').removeClass('active');
	$(id).addClass('active');
}

function nadaFazer(aux)
{
	alert('Voce nao pode curtir e nao curtir');
}

function curtir(id_publicacao)
{
	$.post(
            '/social-uno/index/curtirPublicacao',
            {
                data: id_publicacao
            },
            function (data, status) {
            	soma = $.trim($('.qnt-curtidas-'+id_publicacao).html());
            	if(soma == '')
            		soma = 0; 
           		qnt = parseInt(soma) + 1;
                $('#curtir-'+id_publicacao).removeClass('fa-thumbs-o-up');
                $('#curtir-'+id_publicacao).addClass('fa-thumbs-up');
                $('#curtir-'+id_publicacao+' > .texto-curtr').html('Descutir');
                $('#curtir-'+id_publicacao).removeAttr('onclick');
                $('#curtir-'+id_publicacao).attr('onclick', 'descurtir('+id_publicacao+')');
                $('.qnt-curtidas-'+id_publicacao).html(qnt);

                $('#nao-curti-'+id_publicacao).removeAttr('onclick');
                $('#nao-curti-'+id_publicacao).attr('onclick', 'nadaFazer('+id_publicacao+')');

            }
        );
}

function descurtir(id_publicacao)
{
	$.post(
           '/social-uno/index/descurtirPublicacao',
        {
            data: id_publicacao
        },
        function (data, status) {
            soma = $.trim($('.qnt-curtidas-'+id_publicacao).html());
	    	if(soma == '')
	    		return; 
	   		qnt = parseInt(soma) - 1;
	   		if(qnt == 0)
	   			qnt = '';

	   		$('#curtir-'+id_publicacao).removeClass('fa-thumbs-up');
	   		$('#curtir-'+id_publicacao).addClass('fa-thumbs-o-up');
            $('#curtir-'+id_publicacao).removeAttr('onclick');
            $('#curtir-'+id_publicacao+' > .texto-curtr').html('Curtir');
            $('#curtir-'+id_publicacao).attr('onclick', 'curtir('+id_publicacao+')');
            $('.qnt-curtidas-'+id_publicacao).html(qnt);

            $('#nao-curti-'+id_publicacao).removeAttr('onclick');
            $('#nao-curti-'+id_publicacao).attr('onclick', 'naoCurti('+id_publicacao+')');
          
        }
    );
}

function naoCurti(id_publicacao)
{
	$.post(
           '/social-uno/index/naoCurtiPublicacao',
        {
            data: id_publicacao
        },
        function (data, status) {
                soma = $.trim($('.qnt-nao-curti-'+id_publicacao).html());
            	if(soma == '')
            		soma = 0; 
           		qnt = parseInt(soma) + 1;
                $('#nao-curti-'+id_publicacao).removeClass('fa-thumbs-o-down');
                $('#nao-curti-'+id_publicacao).addClass('fa-thumbs-down');
                $('#nao-curti-'+id_publicacao+' > .texto-nao-curti').html('Desfazer não gostei');
                $('#nao-curti-'+id_publicacao).removeAttr('onclick');
                $('#nao-curti-'+id_publicacao).attr('onclick', 'desfazNaoCurti('+id_publicacao+')');
                $('.qnt-nao-curti-'+id_publicacao).html(qnt);

                $('#curtir-'+id_publicacao).removeAttr('onclick');
                $('#curtir-'+id_publicacao).attr('onclick', 'nadaFazer('+id_publicacao+')');
        }
    );
}

function desfazNaoCurti(id_publicacao)
{
	$.post(
           '/social-uno/index/descurtirPublicacao',
        {
            data: id_publicacao
        },
        function (data, status) {
            soma = $.trim($('.qnt-nao-curti-'+id_publicacao).html());
	    	if(soma == '')
	    		return; 
	   		qnt = parseInt(soma) - 1;
	   		if(qnt == 0)
	   			qnt = '';

	   		$('#nao-curti-'+id_publicacao).removeClass('fa-thumbs-down');
	   		$('#nao-curti-'+id_publicacao).addClass('fa-thumbs-o-down');
            $('#nao-curti-'+id_publicacao).removeAttr('onclick');
            $('#nao-curti-'+id_publicacao+' > .texto-nao-curti').html('Não gostei');
            $('#nao-curti-'+id_publicacao).attr('onclick', 'naoCurti('+id_publicacao+')');
            $('.qnt-nao-curti-'+id_publicacao).html(qnt);

            $('#curtir-'+id_publicacao).removeAttr('onclick');
            $('#curtir-'+id_publicacao).attr('onclick', 'curtir('+id_publicacao+')');
          
        }
    );
}

function ajaxBuscaPrimitive()
{
	var timer;
	
	$('[data-ajax]').keyup(function(e) {
		e.preventDefault();
		
		var obj = $(this);
		var arrNum = [9, 16, 17, 18, 37, 38, 39, 40, 91];
		var callback = obj.attr('data-callback');
		var dataIcon = $(obj.attr('data-icon'));
		var dataResposta = $(obj.attr('data-resposta'));
		
		if(obj.val() != '') {
			if(arrNum.indexOf(e.keyCode) == -1) {
				
				if(dataIcon.html() == '') {
					dataIcon.html('<i class="fa fa-refresh fa-spin fa-lg"></i>');
				}
				
				clearTimeout(timer);
				timer = setTimeout(function() {
					eval(callback);
				}, 1000);
			}
		}
		else {
			dataResposta.addClass('hide');
			dataIcon.html(null);
		}
	
	});
	
}

function ajaxBuscaUsuarios(id) {
	
	var obj = $(id);
	var value = obj.val();
	var dataIcon = $(obj.attr('data-icon'));
	var dataResposta = $(obj.attr('data-resposta'));
	var dataRespostaHtml = dataResposta.find('.resposta-html');
    
    if($.trim(value) != '') {
	
	    data = {
	        'busca': value
	    };
	    
	
        $.post(
            '/social-uno/index/ajax-busca-usuarios',
            {
                data: data
            },
            function (data, status) {
               	dataResposta.removeClass('hide');
                dataRespostaHtml.html(data);
                dataIcon.html(null);
            }
        );
		    
	}
	else {
		 dataResposta.addClass('hide');
	}
    		
}