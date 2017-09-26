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

	public static function dd( $print ) {
		echo "<pre>";
		print_r( $print );
		echo "</pre>";
		die();
	}

	public static function init() {

		$controller = null;
		foreach ( self::$routes['web'] as $route ) {
			if ( $_SERVER['REQUEST_URI'] == $route->url ) {
				$controller = new $route->controller( $route->function );
			}
		}
		foreach ( self::$routes['api'] as $route ) {
			if ( $_SERVER['REQUEST_URI'] == $route->url ) {
				$controller = new $route->controller( $route->function );
			}
		}

		if($controller != null) return;

		header("HTTP/1.0 404 Not Found");
		self::view('errors/404', null, true);
	}

	public static function json( $arr ) {
		header('Content-type: application/json');
		echo json_encode( $arr );
	}

	public static function view( $view = null, $args = null, $error = false ) {
		$page = (object) $args;
		ob_start();
		require_once( "./App/Views/{$view}.php" );
		$content = ob_get_contents();
		ob_end_clean();

		require_once( "Views/" . self::env( 'LAYOUT' ) );
	}
}