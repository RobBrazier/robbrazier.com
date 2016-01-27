<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, width=device-width">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<title>{{ (isset($title)) ? $title.' | ' : '' }}Rob Brazier</title>
	{{ HTML::style('assets/css/style.css') }}
	<link rel="alternate" href="{{ URL::to('blog/feed') }}" title="RSS feed" type="application/rss+xml" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
	<header class="head compact">
		<a href="{{URL::to('/')}}"><img src="{{ URL::to('assets/img/logo-white.png') }}" width="300" height="105" alt="Rob Brazier" class="centered"></a>
	</header>
	<nav>
		<ul>
			{{ HTML::createNav('/', 'Home') }}
			{{ HTML::createNav('about', 'About') }}
			{{ HTML::createNav('blog', 'Blog') }}
			{{ HTML::createNav('projects', 'Projects') }}
		</ul>
	</nav>
	<div class="container">
		{{ $content }}
	</div>
	{{--HTML::script('assets/js/scripts.js')--}}
	<script>
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
	</script>
	<script>
	    var clicky_site_ids = clicky_site_ids || [];
            clicky_site_ids.push(100840739);
            (function() {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//static.getclicky.com/js';
                ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
            })();
	</script>
	<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100840739ns.gif"/></p></noscript>
</body>
</html>
