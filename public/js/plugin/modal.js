(function($) {
	$.fn.modal = function(e) {
		return this.each(function() {
			
			var objModal = $(this);
			var dataTarget = $(objModal.attr('data-target'));
			var	conteudoModal = dataTarget.find('.div-conteudo-modal'); 
			var timerModal;
				
			function modalOpen()
			{
				$('body').addClass('modal-open');			
				dataTarget.addClass('transition-open');
				clearTimeout(timerModal);
				timerModal = setTimeout(function() {
					dataTarget.addClass('open');
					dataTarget.removeClass('transition-open');
				}, 500);
			}
			
			function modalClose()
			{
				$('body').removeClass('modal-open');				
				dataTarget.addClass('transition-close');
				clearTimeout(timerModal);
				timerModal = setTimeout(function() {
					dataTarget.removeClass('open');
					dataTarget.removeClass('transition-close');				
				}, 500);
			}		
			
			objModal.click(function(e) {
				e.preventDefault();
				modalOpen();								
			});
			
			objModal.keyup(function(e) {
				e.preventDefault();
				if(e.keyCode == 27) {
					modalClose();
				}				
			});
			
			dataTarget.click(function(e) {
				e.preventDefault();
				modalClose();				
			});
			
			conteudoModal.click(function(e) {
				e.stopPropagation();
			});			
				
		});
	};
})(jQuery);

$(document).ready(function() {
	$('[data-toggle="modal"]').modal();
});