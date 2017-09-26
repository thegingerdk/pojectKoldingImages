<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 08.58
 */

class App {
	public $env;

	private function env (){
		$env = explode('\n', file_get_contents('/.env'));

	}
}