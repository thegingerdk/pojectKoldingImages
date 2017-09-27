<?php

class HomeController extends Controller {
	public function index() {
		$title = "En side";

		app::view( 'home', compact( 'title' ) );
	}
}