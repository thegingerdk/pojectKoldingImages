<?php

class AuthController extends Controller {
	public function index() {
		$title = "Login / Register";

		app::view( 'login-register', compact( 'title' ) );
	}
	public function login() {

	}
	public function register() {

	}
}