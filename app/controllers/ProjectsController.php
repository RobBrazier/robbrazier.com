<?php

class ProjectsController extends BaseController {

	protected $layout = 'layouts.default';

	public function getIndex() {
		$this->layout->title = 'Projects';
		$this->layout->content = View::make('projects.index');
	}

	public function getCoolrob335() {
		$this->layout->title = 'coolrob335.com';
		$this->layout->content = View::make('projects.coolrob335');
	}

	public function getEntitydecode() {
		$this->layout->title = 'EntityDecode';
		$this->layout->content = View::make('projects.entitydecode');
	}

	public function getRecloud() {
		$this->layout->title = 'reCloud';
		$this->layout->content = View::make('projects.recloud');
	}

	public function getMypcspecs() {
		$this->layout->title = 'My PC Specs';
		$this->layout->content = View::make('projects.mypcspecs');
	}

	public function getLaravelPiwik($param='') {
		if(false !== stripos(Request::server('HTTP_REFERER'), "piwik.org")){
			return Redirect::to('http://laravel-piwik.robbrazier.com/en/latest/installation.html');
		} else {
			if($param == 'installation:l3') {
				return Redirect::to('http://laravel-piwik.robbrazier.com/en/latest/installation-l3.html');
			} else if($param == 'installation:l4') {
				return Redirect::to('http://laravel-piwik.robbrazier.com/en/latest/installation.html');
			} else {
				return Redirect::to('http://laravel-piwik.robbrazier.com');
			}
		}
	}
	
}