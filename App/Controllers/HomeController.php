<?php

class HomeController extends Controller {
	public function index() {
		$title = "En side";

		$user = User::find(3);

		$user->delete();

		app::dd($user);

		app::view( 'home', compact( 'title' ) );
	}
}