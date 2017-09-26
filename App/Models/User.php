<?php
namespace App;

class User extends DataBase {

	/**
	 * Primary Key
	 * @var  int */
	private $ID;
	/**
	 * User Email, for subscriptions and login
	 * @var string unique */
	private $email;
	/**
	 * Users First name
	 * @var  string */
	private $firstname;
	/**
	 * Users Last name
	 * @var  string */
	private $lastname;
	/**
	 * Encrypted password
	 * @var  string */
	private $password;
	/**
	 * Searchable username
	 * @var  string */
	private $nickname;

}