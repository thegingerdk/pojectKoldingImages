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

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
        
        
    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    
    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }



}