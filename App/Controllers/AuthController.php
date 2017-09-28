<?php

class AuthController extends Controller {
	public function index() {

		if(app::auth()) app::redirect('/images');

		$title = "IMITO | Login / Register";

		app::view( 'login-register', compact( 'title' ) );
	}

	public function login() {
		if ( $user = User::login( $_POST['email'], $_POST['password'] ) ) {
			app::redirect( '/' );
		} else {
			app::redirect( '/login', 'No user with that password and email combination exists!' );
		}
	}

	public function register() {
		$user = User::register();

		User::login( $user->email,  $_POST['password']);

		app::redirect( '/' );
	}

	public function logout() {
		User::logout();
		app::redirect( '/login' );
	}
}