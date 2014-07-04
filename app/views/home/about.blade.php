<h1>About Me</h1>
<hr>
<section class="about">
	<?php
		$birthDate = "13/06/1995";
		$birthDate = explode("/", $birthDate);
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
	?>
	{{ HTML::image('assets/img/profpic.png', 'Rob Brazier', array('class' => 'profpic')) }}
	<h2>Hi, I'm Rob Brazier. I am {{ $age }} Years Old.<br>
		I am a Web Developer.</h2>
</section>

<div class="about-main">
	<h3>Quick Bio:</h3>
	<p>I started on the web in early 2011, and have been learning web technologies since then.</p>

	<p>I have taught myself PHP, HTML, CSS, JavaScript, mainly jQuery. I have been using the awesome <a href="http://teamtreehouse.com">teamtreehouse.com</a> as a resource for Web Education, and I have become a verified Treehouse <a href="http://teamtreehouse.com/robbrazier">member</a>.</p>

	<p>I am also working with, and maintaining Linux Virtual Servers, so I have experience using Linux commands.</p>

	@if(Session::has('contact'))
	<p class="selected">
	@else
	<p>
	@endif
	If you want to contact me, I'd recommend using twitter <a href="http://twitter.com/robbrazier_">@robbrazier_</a></p>
</div>
<hr>
<div class="about-skills">
	<h3>Programming Languages</h3>
	<p>Key:</p>
	<p>{{ HTML::stars(1) }} = Beginner<br>
	   {{ HTML::stars(2) }} = Familiar<br>
	   {{ HTML::stars(3) }} = Proficient<br>
	   {{ HTML::stars(4) }} = Expert<br>
	   {{ HTML::stars(5) }} = Master</p>
	<ul style="padding-left: 25px;">
		<li>PHP {{ HTML::stars(4) }}</li>
		<li>HTML {{ HTML::stars(4) }}</li>
		<li>CSS {{ HTML::stars(3) }}</li>
		<li>Javascript {{ HTML::stars(4) }}</li>
		<li>jQuery {{ HTML::stars(3) }}</li>
	</ul>
</div>
<hr>
<div class="about-social">
	<h3 id="connect">Connect With Me</h3>

	<p>I can be found on the following Websites:</p>
	<p><a href="https://github.com/RobBrazier"><b class="icon-github"></b>GitHub</a> - I Host most of my Open Source Projects here</p>
	<p><a href="https://linkedin.com/in/robbrazier1"><b class="icon-linkedin"></b>LinkedIn</a> - I... Have an account, nothing much more to say</p>
	<p><a href="https://gplus.to/RobBrazier"><b class="icon-gplus"></b>Google+</a> - I don't really post anything on this, but you can Circle me if you wish</p>
	@if(Session::has('contact'))
	<p class="selected">
	@else
	<p>
	@endif
		<a href="https://twitter.com/robbrazier_"><b class="icon-twitter"></b>Twitter</a> - I usually post status updates for my websites here, and this is the best way to contact me</p>

</div>