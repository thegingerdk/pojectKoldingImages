<?php

class HomeController extends Controller {
	public function index() {
		$title = "Images Galoure";
		$pictures = ( new Picture() )->orderBy( 'rand()' );

		$user = null;

		if ( app::auth() ) {

			$user = User::find( app::authId() );
			$user->ratings();
		}

		app::view( 'home', compact( 'title', 'pictures', 'user' ) );
	}
}