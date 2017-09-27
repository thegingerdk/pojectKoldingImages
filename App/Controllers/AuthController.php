<?php

class AuthController extends Controller {
	public function index() {
		$title = "Login / Register";

		app::view( 'login-register', compact( 'title' ) );
	}

	public function login() {
		if ( $user = User::login( $_POST ) ) {
			app::redirect( '/' );
		} else {
			app::redirect( '/login', 'No user with that password and email combination exists!' );
		}
	}

	public function register() {
		$user = new User( $_POST );

		$user->save();

		app::redirect( '/login' );
	}

	public function logout() {
		User::logout();
		app::redirect( '/login' );
	}
}