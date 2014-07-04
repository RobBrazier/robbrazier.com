<?php

class BlogController extends BaseController {

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

		$this->layout->title = 'Blog';
		$this->layout->content = View::make('blog.index', compact(array('posts')));
	}

	public function getPost($slug) {
		if(file_exists(storage_path('posts/'.$slug.'.md'))) {
			$source = file_get_contents(storage_path('posts/'.$slug.'.md'));

			// Create a new document parser
			$parser = new Kurenai\DocumentParser;

			// Parse the loaded source.
			$document = $parser->parse($source);

			// To get the document content in raw markdown format..
			// This is my **markdown** content!
			// $rawMarkdown = $document->getContent();

			// To get the converted HTML content..
			// <p>This is my <strong>markdown</strong> content!</p>
			$html = $document->getHtmlContent();

			// To access the full array of metadata
			// array(
			//      'title'     => 'This is my document title.',
			//      'slug'      => 'this-is-the-slug',
			//      'date'      => '12th December 1984'
			// );
			$metadata = $document->get();

			// To access a piece of metadata by key (default: null)..
			// this-is-the-slug
			$slug = $document->get('slug');
			$title = $document->get('title');
			$date = $document->get('date');
			$this->layout->title = $title;
			$this->layout->content = View::make('blog.post', compact(array('html', 'metadata')));
		} else {
			App::abort(404);
		}
	}
	
}