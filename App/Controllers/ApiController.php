<?php

class ApiController extends Controller {

	private $pictures = "";

	public function index() {
		app::json( [ 'test' => 'json' ] );
	}

	public function rate() {
		app::checkApiAuth();

		$rated = true;

		$r = Rating::check();

		if(! $r) {
			$rating            = new Rating();
			$rating->rating    = $_GET['rating'];
			$rating->pictureID = $_GET['pid'];
			$rating->userID    = app::authId();
			$rating->save();
		} else $rated = false;

		app::json( [ 'rated' => $rated ] );
	}


	public function upload() {

		app::checkApiAuth();

		$picture = new Picture( $_POST );
		$picture->save();

		app::back();

		app::json( $picture->toArray() );
	}


	public function delete() {

		$ID = $_GET['pid'];

		app::checkApiAuth();

		Picture::delete( $ID );

		$pictures = Picture::get( [
			[ 'userID', '=', app::authId() ]
		] );

		app::json( [
			'pictures' => app::arrayToJSON( $pictures ),
		] );
	}

	public function getImages() {

		$options = [];

		if ( isset( $_GET['my-images'] ) ) {
			$options[] = [ 'userID', '=', app::authId() ];
		} else {
			$options['order'] = 'rand()';
		}

		$pictures = Picture::get( $options );

		$ratings = Rating::get( [
			[ 'userID', '=', app::authId() ]
		] );

		app::json( [
			'pictures' => app::arrayToJSON( $pictures ),
			'ratings'  => app::arrayToJSON( $ratings )
		] );

	}
}