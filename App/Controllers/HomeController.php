<?php

class HomeController extends Controller {
	public function index() {
		$title = "En side";

		app::view( 'home', compact( 'title' ) );
	}

	public function upload() {
		if(! app::auth()) {
			app::redirect('/login');
		}
		$title = "Upload image";

		app::view( 'upload', compact( 'title' ) );
	}

	public function uploadPost() {
		$picture = (new Picture())->save();

		app::view( 'upload', compact( 'picture' ) );
	}
}