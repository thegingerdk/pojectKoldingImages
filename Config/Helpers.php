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

	public static function back($msg = "") {
		self::redirect($_SERVER['HTTP_REFERER'], $msg);
	}

	public static function redirect ($str, $msg = ""){
		$_SESSION['msg'] = $msg;
		header("Location: {$str}");
	}

	public static function checkAuth() {
		if ( ! self::auth() ) {
			self::redirect( '/login' );
		}
	}

	public static function auth (){
		return isset($_SESSION['authenticated']) ? $_SESSION['authenticated'] : false;
	}

	public static function authId (){
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

	public static function resizeImage($newWidth, $targetFile, $originalFile) {

		$info = getimagesize( $originalFile );
		$mime = $info['mime'];

		switch ( $mime ) {
			case 'image/jpeg':
				$image_create_func = 'imagecreatefromjpeg';
				$image_save_func   = 'imagejpeg';
				$new_image_ext     = 'jpg';
				break;

			case 'image/png':
				$image_create_func = 'imagecreatefrompng';
				$image_save_func   = 'imagepng';
				$new_image_ext     = 'png';
				break;

			case 'image/gif':
				$image_create_func = 'imagecreatefromgif';
				$image_save_func   = 'imagegif';
				$new_image_ext     = 'gif';
				break;

			default:
				throw new Exception( 'Unknown image type.' );
		}

		$img = $image_create_func( $originalFile );
		list( $width, $height ) = getimagesize( $originalFile );

		if($width < $height) {
			$newHeight = ( $height / $width ) * $newWidth;
		}else {
			$newHeight = $newWidth;
			$newWidth = ( $width / $height ) * $newHeight;
		}

		$tmp       = imagecreatetruecolor( $newWidth, $newHeight );
		imagecopyresampled( $tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height );

		if ( file_exists( $targetFile ) ) {
			unlink( $targetFile );
		}
		$image_save_func( $tmp, "$targetFile" );
	}
}