<h1>Blog</h1>
<hr>
<?php $i=0; ?>
@foreach($posts as $p)
<article>
	<h2><a href="{{ URL::to('blog/'.$p['slug']) }}">{{ $p['title'] }}</a></h2>
	<em>Posted on {{ $p['date'] }}</em>
	{{ Str::limit($p['content'], 500) }}
	<a href="{{ URL::to('blog/'.$p['slug']) }}">Read More</a>
</article>
@if($i != count($posts)-1)
<br>
@endif
<?php $i++; ?>
@endforeach