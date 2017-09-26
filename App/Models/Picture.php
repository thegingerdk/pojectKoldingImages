<?php


class Picture extends DataBase {

	protected $tableName = "tablename";
	protected $classAttributes = ['ID', '..', '..'];

	/**
	 * Primary Key
	 * @var  integer */
	protected $ID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer */
	protected $userID;
	/**
	 * Image Caption
	 * @var  string */
	protected $caption;
	/**
	 * Path to image
	 * @var  string */
	protected $imageData;
	/**
	 * Blob backup of image
	 * @var  string */
	protected $imageBackup;
	/**
	 * Image MimeType
	 * @var  integer */
	protected $mime;
	/**
	 * Image Description / Story
	 * @var  string */
	protected $story;
	/**
	 * Keywords of image
	 * @var  string */
	protected $tags;

}