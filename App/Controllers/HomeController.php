<?php

class HomeController extends Controller {
	public function index() {
		$title    = "Images Galoure";
		$pictures = ( new Picture() )->orderBy( 'rand()' );

		$user = null;

		if ( app::auth() ) {

			$user = User::find( app::authId() );
			$user->ratings();
		}

		app::view( 'home', compact( 'title', 'pictures', 'user' ) );
	}

	public function images() {
		app::checkAuth();

		$user = User::find( app::authId() );

		$title    = "Delete images";
		$pictures = Picture::get( [
			['userID','=',$user->ID]
		] );
		$delete   = true;

		app::view( 'home', compact( 'title', 'pictures', 'user', 'delete' ) );
	}
}