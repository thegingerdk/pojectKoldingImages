<?php

class HomeController extends Controller {
	public function index() {
		$title = "Images Galoure";

		$pictures = ( new Picture() )->orderBy( 'rand()' );

		$user = app::auth() ? User::find( app::authId() ) : null;

		$user->ratings();

		app::view( 'home', compact( 'title', 'pictures', 'user' ) );
	}
}