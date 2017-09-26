<?php

class HomeController {
	private $route;
	public function __construct($function) {
		$this->$function();
	}

	public function index() {

		app::render('home');
	}
}