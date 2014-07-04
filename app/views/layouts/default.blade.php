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
    <a href='https://alpha.app.net/robbrazier' rel='me' style="display:none;visibility:hidden" aria-hidden="true">robbrazier @ app.net</a>
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
	<!-- Piwik -->
	<script type="text/javascript">
		var _paq = _paq || [];
		_paq.push(["trackPageView"]);
		_paq.push(["enableLinkTracking"]);

		(function() {
			var u=(("https:" == document.location.protocol) ? "https" : "http") + "://stats.robbrazier.com/";
			_paq.push(["setTrackerUrl", u+"piwik.php"]);
			_paq.push(["setSiteId", "2"]);
			var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
			g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
		})();
	</script>
	<!-- End Piwik Code -->
</body>
</html>