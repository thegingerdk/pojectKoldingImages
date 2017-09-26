<?php

/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 25/09/2017
 * Time: 12.09
 */
class DataBase {
	/**
	 * DB Table name
	 * @var string
	 */
	private $tableName = "";
	/**
	 * Array of row names
	 * @var array
	 */
	private $columns = [];
	private $values = [];

	public $errors = [];

	/**
	 * Loads when DataBase class initialised
	 * DataBase constructor.
	 */
	public function __construct() {
		$this->tableName = strtolower( get_class( $this ) ) . "s";
		$vars            = ( get_object_vars( $this ) );

		unset( $vars['hidden'] );
		unset( $vars['tableName'] );
		unset( $vars['columns'] );
		unset( $vars['values'] );

		$this->columns = $vars;
	}

	/**
	 * Loads when DataBase class unlinked
	 */
	public function __destruct() {
		// TODO: Close DB connection
	}

	/**
	 * Saves data to DB
	 *
	 * @param int $id
	 */
	public function save( $values = [], $id = 0 ) {
		$this->values = $values;
		if ( $id === 0 ) {
			return $this->create();
		} else {
			return $this->update( $id );
		}
	}

	/**
	 * @param $sql
	 *
	 * @return bool
	 */
	private function query( $sql ) {
		if ( $result = app::$conn->query( $sql ) === true ) {
			unset( $this->errors['db'] );

			return $result;
		} else {
			$this->errors['db'] = "Error: " . $sql . "<br>" . app::$conn->error;

			return false;
		}
	}

	/**
	 * Creates a new item in DB
	 *
	 * @return bool
	 */
	private function create() {
		// TODO: INSERT NEW ROW
		$sql = "INSERT INTO {$this->tableName} (";

		$columns = $this->columns;
		unset( $columns['ID'] );

		foreach ( $columns as $column => $val ) {
			$columns[ $column ] = isset( $this->values[ $column ] ) ? $this->values[ $column ] : '';
		}

		$sql .= implode( ",", array_keys( $columns ) );

		$sql .= ") VALUES (";

		$sql .= "'" . implode( "','", $columns ) . "'";

		$sql .= ")";

		return $this->query($sql);
	}

	/**
	 * Updates a row in DB
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	private function update( $id ) {
		// TODO: UPDATE EXISTING ROW

		return false;
	}

	/**
	 * If query false, all rows selected, otherwise query will be run
	 *
	 * @param bool $query
	 * @param null $order
	 * @param null $sort
	 */
	public function select( $query = false, $order = null, $sort = null ) {
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
	public function search( $str = null ) {
		// TODO: SELECT based on search string
	}

	/**
	 * Delete row
	 *
	 * @param int $id
	 */
	public function delete( $id = 0 ) {
		// TODO: Delete row from DataBase
	}
}
