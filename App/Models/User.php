<?php

class User extends Auth {

	protected $hidden = ['password', 'ratings'];

	/**
	 * Primary Key
	 * @var  int */
	protected $ID;
	/**
	 * User Email, for subscriptions and login
	 * @var string unique */
	protected $email;
	/**
	 * Users First name
	 * @var  string */
	protected $firstname;
	/**
	 * Users Last name
	 * @var  string */
	protected $lastname;
	/**
	 * Encrypted password
	 * @var  string */
	protected $password;
	/**
	 * Searchable username
	 * @var  string */
	protected $nickname;

	public $ratings;

	public function ratings (){
		$ratings = Rating::get([
			['userID', '=', app::authId()]
		]);

		foreach ( $ratings as $rating ) {
			$this->ratings[$rating->pictureID] = $rating;
		}
	}
}