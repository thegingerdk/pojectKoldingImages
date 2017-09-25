<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 25/09/2017
 * Time: 12.04
 */

class Rating extends DataBase {

	/**
	 * Picture Primary Key
	 * Foreign Key
	 * @var  integer */
	private $pictureID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer */
	private $userID;
	/**
	 * 0: Dislike
	 * 1: Like
	 * 2: Favorite
	 * 3: Super Image
	 * @var  integer */
	private $rating;

}