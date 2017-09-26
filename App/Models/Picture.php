<?php
namespace App;


class Picture extends DataBase {

	protected $tableName = "tablename";
	protected $classAttributes = ['ID', '..', '..'];

	/**
	 * Primary Key
	 * @var  integer */
	private $ID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer */
	private $userID;
	/**
	 * Image Caption
	 * @var  string */
	private $caption;
	/**
	 * Path to image
	 * @var  string */
	private $imageData;
	/**
	 * Blob backup of image
	 * @var  string */
	private $imageBackup;
	/**
	 * Image MimeType
	 * @var  integer */
	private $mime;
	/**
	 * Image Description / Story
	 * @var  string */
	private $story;
	/**
	 * Keywords of image
	 * @var  string */
	private $tags;

}