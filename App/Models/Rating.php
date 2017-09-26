<?php

class Rating extends Models {

	/**
	 * Picture Primary Key
	 * Foreign Key
	 * @var  integer */
	protected $pictureID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer */
	protected $userID;
	/**
	 * 0: Dislike
	 * 1: Like
	 * 2: Favorite
	 * 3: Super Image
	 * @var  integer */
	protected $rating;

}