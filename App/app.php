<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 08.58
 */

class app {

	public static $env;
	public static $db;

	public static function env($name = null) {
		$env = [];

		foreach (  explode( PHP_EOL, file_get_contents( './.env' ) ) as $item ) {
			$item = explode(':', $item);
			$env[trim($item[0])] = trim($item[1]);
		}


		return !is_null($name) && !empty($env[$name]) ? $env[$name] : false;
	}

	public static function layout() {
		require_once("Views/layout.php");
	}

	public static function p(){}
}