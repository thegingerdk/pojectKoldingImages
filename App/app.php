<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 08.58
 */

class app extends Helpers {

	public static $conn;
	public static $msg;
	public static $routes = [];
	public static $errors = [];

	public static function init() {

		$controller = null;
		$url = explode('?', $_SERVER['REQUEST_URI'])[0];

		foreach ( self::$routes[ $_SERVER['REQUEST_METHOD'] == 'POST' ? 'post' : 'get' ] as $route ) {

			if ($url  == $route->url ) {

				$controller = new $route->controller( $route->function );
			}
		}

		if ( $controller != null ) {
			return;
		}

		header( "HTTP/1.0 404 Not Found" );

		self::view( 'errors/404', null, true );
	}

	public static function json( $arr ) {
		header( 'Content-type: application/json' );
		echo json_encode( $arr );
	}

	public static function view( $view = null, $args = null, $error = false ) {
		$page = (object) $args;

		if (isset($_SESSION['msg'])){
			self::$msg = $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		ob_start();
		require_once( "./Resources/Views/{$view}.php" );
		$content = ob_get_contents();
		ob_end_clean();

		require_once( "./Resources/views/" . self::env( 'LAYOUT' ) );
	}
}