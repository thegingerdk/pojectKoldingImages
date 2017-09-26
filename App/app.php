<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 08.58
 */

class app {

	public static $env;
	public static $conn;
	public static $routes = [];

	public static function env( $name = null ) {
		$env = [];

		foreach ( explode( PHP_EOL, file_get_contents( './.env' ) ) as $item ) {
			$item                    = explode( ':', $item );
			$env[ trim( $item[0] ) ] = trim( $item[1] );
		}


		return ! is_null( $name ) && ! empty( $env[ $name ] ) ? $env[ $name ] : false;
	}

	public static function p( $print ) {
		echo "<pre>";
		print_r( $print );
		echo "</pre>";
	}

	public static function init() {

		foreach ( self::$routes as $route ) {
			if($_SERVER['REQUEST_URI'] == $route->url) {
				$controller = new $route->controller($route->function);
			}
		}
	}


	public static function render($view = null) {

		ob_start();

		ob_clean();

		require_once( "Views/layout.php" );
	}
}