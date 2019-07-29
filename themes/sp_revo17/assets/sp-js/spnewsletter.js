$(document).ready(function($){
		$(".close").click(function(){
			$('#newsletter_block_popup').fadeOut('medium');
		});
	  
		$('.ckmsg').off('click').on('click', function(e){
			var  c = 'checked', isChecked = $("input.ckmsg").is(":" + c);
			var _checked = $("input.ckmsg:checked").length;
			var options = {};
			options.expires = 1; 
			if (_checked) {
				$.cookie('sp_news_letter',1, options);
			}else{
				$.cookie('sp_news_letter',null);
			}
		});
	  
		$('.check_lable').off('click').on('click', function(e){
			e.preventDefault();
			var  c = 'checked', isChecked = $("input.ckmsg").is(":" + c);
			isChecked ?  $("input.ckmsg").attr('checked', false) : $("input.ckmsg").attr('checked', true);
			var _checked = $("input.ckmsg:checked").length;
			_checked ?  $('.msg  span').addClass('checked') :  $('.msg  span').removeClass('checked', 'checked');
			var options = {};
				options.expires = 1; 
			if (_checked) {
				$.cookie('sp_news_letter',1, options);
			}else{
				$.cookie('sp_news_letter',null);
			}
		});
	 });