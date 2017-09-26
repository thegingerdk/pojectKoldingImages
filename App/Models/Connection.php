<?php
class Connection {

	private $connection;

	public function open() {
		$this->connection = new mysqli(
			app::env('DB_HOST'),
			app::env('DB_USER'),
			app::env('DB_PASS'),
			app::env('DB_NAME'));

		return $this->connection;
	}

	public function close() {
		unset($this->connection);
	}
}

