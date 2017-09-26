<?php

class DataBase {

	/**
	 * Connection name
	 * @var string
	 */
	private $connection;
	/**
	 * DB Table name
	 * @var string
	 */
	protected $tableName = "";
	/**
	 * Array of row names
	 * @var array
	 */
	protected $classAttributes = [];

	/**
	 * Loads when DataBase class initialised
	 * DataBase constructor.
	 */
	public function __construct() {

		echo "<pre>";
		print_r(app::$db);
		echo "<";
		$sql = "INSERT INTO users (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";

		if (app::$db->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . app::$db->error;
		}

	}

	/**
	 * Saves data to DB
	 *
	 * @param int $id
	 */
	public function save( $id = 0 ) {
		if ( $id === 0 ) {
			$this->create();
		} else {
			$this->update( $id );
		}
	}

	/**
	 * Creates a new item in DB
	 */
	private function create() {
		// TODO: INSERT NEW ROW
	}

	/**
	 * Updates a row in DB
	 *
	 * @param $id
	 */
	private function update( $id ) {
		// TODO: UPDATE EXISTING ROW
	}

	/**
	 * If query false, all rows selected, otherwise query will be run
	 *
	 * @param bool $query
	 * @param null $order
	 * @param null $sort
	 */
	public function select($query = false, $order = null, $sort = null) {
		// TODO: SELECT ROWS
	}

	/**
	 * Selects single row in DB, based on ID
	 *
	 * @param int $id
	 */
	public function find( $id = 0 ) {
		// TODO: SELECT single row
	}

	/**
	 * Searches DB for items equal or partially equal
	 *
	 * @param $str
	 */
	public function search($str = null) {
		// TODO: SELECT based on search string
	}

	/**
	 * Delete row
	 *
	 * @param int $id
	 */
	public function delete($id = 0) {
		// TODO: Delete row from DataBase
	}
}
