$(function() {
	navOffset = $('nav').offset().top;
	$(window).resize(function(){
		navOffset = $('nav').offset().top;
	});
	$(window).scroll(function() {
		if($(window).scrollTop() >= navOffset){
			if(!$('nav').attr('style')){
				div = document.createElement('div');
				$(div).attr('style', 'height: '+$('nav').height()+'px');
				div.classList.add('navScrollPlaceholder');
				div.innerHTML = ' ';
				document.getElementsByTagName('body')[0].insertBefore(div, document.getElementsByTagName('header')[0].nextSibling);
				$('nav').css('position', 'fixed').css('top', '0').css('display', 'inline-block').css('width', '100%');
				$('nav ul').css('margin', '0');
			}
		} else {
			$('nav').removeAttr('style');
			$('nav ul').removeAttr('style');
			$('div.navScrollPlaceholder').remove();
		}
	});
});