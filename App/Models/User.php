<?php

class User extends Models {

	protected $hidden = ['password'];

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

}