<?php
class Connection {

	private static $instance;
	private $connection;

	public function __construct() {
		$this->connection = new mysqli(
			app::env('DB_HOST'),
			app::env('DB_USER'),
			app::env('DB_PASS'));
	}

	public function con () {
		return $this->connection;
	}

	public static function open() {
		if (self::$instance == null) {
			self::$instance = new Connection();
		}

		return self::$instance;
	}

	public static function close() {

	}
}

