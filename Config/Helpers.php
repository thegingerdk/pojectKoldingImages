<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 27/09/2017
 * Time: 10.43
 */

class Helpers {


	public static $env;
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
		self::p($print);
		die();
	}

	public static function hash ($str){
		return password_hash($str, PASSWORD_DEFAULT);
	}

	public static function redirect ($str, $msg = ""){
		$_SESSION['msg'] = $msg;
		header("Location: {$str}");
	}

	public static function auth (){
		return isset($_SESSION['authenticated']) ? $_SESSION['authenticated'] : false;
	}

	public static function uid (){
		return isset($_SESSION['uid']) ? $_SESSION['uid'] : false;
	}

	public static function randomStr ($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}