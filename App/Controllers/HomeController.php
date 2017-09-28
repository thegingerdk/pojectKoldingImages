<?php

class HomeController extends Controller {
	public function index() {
		$title    = "IMITO";

		app::view( 'home', compact( 'title' ) );
	}

	public function images() {
		app::checkAuth();
		$delete = true;
		$title    = "My Images";

		app::view( 'home', compact( 'title', 'delete' ) );
	}

	public function copyrights() {
		$title    = "IMITO | Copyright Terms";

		app::view( 'terms-conditions', compact( 'title' ) );
	}
}