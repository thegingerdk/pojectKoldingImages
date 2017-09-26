<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 08.58
 */

class app {

	public static function env() {
		$env = explode( '\n', file_get_contents( '/.env' ) );
	}

	public static function layout() {
		require_once("Views/layout.php");
	}
}