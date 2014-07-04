<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.default';

	public function getIndex() {
		$posts = glob(storage_path('posts/*.md'));
		$po = array();
		foreach($posts as $p) {
			$source = file_get_contents($p);
			$parser = new Kurenai\DocumentParser;
			$document = $parser->parse($source);
			$date = $document->get('date');
			$d = strtotime($date);
			$po[$d] = array(
				'slug' => $document->get('slug'),
				'title' => $document->get('title'),
				'content' => $document->getHtmlContent(),
				'date' => $document->get('date')
			);
		}
		$posts = $po;
		ksort($posts);
		$posts = array_reverse($posts, true);
		
		$this->layout->title = 'Home';
		$this->layout->content = View::make('home.index', compact(array('posts')));
	}

	public function getAbout() {
		$this->layout->title = 'About';
		$this->layout->content = View::make('home.about');
	}

	public function getContact() {
		return Redirect::to('about#connect')->with('contact', 'true');
	}

}