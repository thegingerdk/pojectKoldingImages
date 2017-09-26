<?php

class ApiController extends Controller {

	public function index() {
		app::json(['test' => 'json']);
	}
}