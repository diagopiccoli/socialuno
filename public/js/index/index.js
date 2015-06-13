$(document).ready(function() {
	marcaMenu('#li-publicacoes');
});

$("#form-publicacao").submit(function (event) {

	event.preventDefault();
	event.stopPropagation();
    var formData = new FormData(this);

    $.ajax({
        url:  '/social-uno/index/savePublicacao',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
         	if(data){
         		window.location.reload();
         	}else{
         		alert('error');
         	}
        },
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        return myXhr;
        }
    });
});

$('#fotosLinhaTempo').change(function(){
    var qtde = this.files.length; 
    if(qtde > 4) { 
     	alert("Não é permitido enviar mais do que 5 arquivos.");
     	$('.quantidade-imagens').html('');
       	$(this).val("");
       	return false;
    } 
    $('.quantidade-imagens').html('Quantidade de imagens: '+qtde+'/4');
    return true;
});