<?php

class Auth extends Models {

	public static function login( $email, $password ) {
		$query = [
			"WHERE email='{$email}'",
			"hidden" => false
		];


		$user = ( new User() )->single( $query, "ID,password,email" );

		if ( $user && password_verify( $password, $user->password ) ) {
			$_SESSION['uid']           = $user->ID;
			$_SESSION['authenticated'] = true;

			return $user;
		}

		return false;

	}

	public static function register() {
		$user = new User( $_POST );

		$user->password = app::hash( $user->password );

		$user->save();

		return $user;
	}


	public static function logout() {
		unset( $_SESSION['uid'] );
		unset( $_SESSION['authenticated'] );
	}
}