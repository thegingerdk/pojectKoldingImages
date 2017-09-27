<?php

class Auth extends Models{

	public static function login ($args){
		$email  = $_POST['email'];
		$password  = $_POST['password'];

		echo $password;

		$query = [
			"WHERE email='{$email}'"
		];

		$user = (new User())->where($query);

		if($user && password_verify($password, $user->password)){
			$_SESSION['uid'] = $user->ID;
			$_SESSION['authenticated'] = true;
			return $user;
		}

		return false;

	}


	public static function logout() {
		unset($_SESSION['uid']);
		unset($_SESSION['authenticated']);
	}
}