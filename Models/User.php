<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 25/09/2017
 * Time: 12.02
 */

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