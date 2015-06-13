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

/*
function ajaxBuscaUsuarios()
{
    var timer;
    
    $('#find_friends').keyup(function(e) {
		e.preventDefault();
		var arrNum = [9, 16, 17, 18, 37, 38, 39, 40, 91];
	
		if(arrNum.indexOf(e.keyCode) == -1) {
		
	        value = this.value;
	        clearTimeout(timer);
	        if($.trim(value) == '') {
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
		
		}

    });

}
*/

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