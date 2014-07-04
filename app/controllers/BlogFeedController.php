<?php

class BlogFeedController extends BaseController {

	public function getFeed() {
    	header("Content-Type: application/rss+xml; charset=ISO-8859-1");
		$posts = glob(storage_path('posts/*.md'));

		$parser = new Kurenai\DocumentParser;
		$feed = array();
		foreach ($posts as $node) {
			$post = file_get_contents($node);
			$document = $parser->parse($post);
			$item = array ( 
				'title' => $document->get('title'),
				'desc' => strip_tags(Str::limit($document->getHtmlContent(), 100)),
				'link' => URL::to('blog/'.$document->get('slug')),
				'date' => $document->get('date'),
				);
			array_push($feed, $item);
		}
		// if(count($feed) < 5) {
			$limit = count($feed);
		// } else {
		// 	$limit = 5;
		// }
		$rss = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$rss .= '<rss version="2.0">';
    	$rss .= '<channel>';
        $rss .= '<title>Rob Brazier Feed</title>';
        $rss .= '<link>http://robbrazier.com/</link>';
        $rss .= '<description>This is the RSS Feed for the Blog on robbrazier.com</description>';
        $rss .= '<language>en-gb</language>';
        $rss .= '<copyright>Copyright (C) 2014 robbrazier.com</copyright>';
		for($x=0;$x<$limit;$x++) {
			$rss .= '<item>';
			$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
			$link = $feed[$x]['link'];
			$description = $feed[$x]['desc'];
			$date = date('D, d M Y H:i:s O', strtotime($feed[$x]['date']));
			$rss .= '<title>'.$title.'</title>';
			$rss .= '<description>'.$description.'</description>';
			$rss .= '<link>'.$link.'</link>';
			$rss .= '<pubDate>'.$date.'</pubDate>';
			$rss .= '</item>';
		}
		$rss .= '</channel>';
		$rss .= '</rss>';
		return $rss;
	}

}