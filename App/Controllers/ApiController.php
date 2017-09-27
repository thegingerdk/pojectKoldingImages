<?php

class ApiController extends Controller {

	public function index() {
		app::json( [ 'test' => 'json' ] );
	}

	public function rate() {
		app::checkAuth();

		$rating = new Rating($_POST);
		$rating->userID = app::authId();
		$rating->save();

		app::back();

		app::json( [ 'test' => $_POST['rating'] ] );
	}


	public function upload() {

		app::checkAuth();

		$picture = new Picture( $_POST );
		$picture->save();

		app::back();

		app::json( $picture->toArray() );
	}
}