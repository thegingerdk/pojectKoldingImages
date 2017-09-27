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
	private $class = "";
	/**
	 * Array of row names
	 * @var array
	 */
	private $columns = [];

	private $noUse = [ 'hidden', 'tableName', 'columns', 'noUse', 'class' ];

	/**
	 * Loads when DataBase class initialised
	 * DataBase constructor.
	 */
	public function __construct() {
		$this->class     = get_class( $this );
		$this->tableName = strtolower( $this->class ) . "s";
		$this->updateColumns();
	}

	private function updateColumns() {

		$vars = ( get_object_vars( $this ) );
		foreach ( $this->noUse as $item ) {
			unset( $vars[ $item ] );
		}

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
	 */
	public function save() {
		$this->updateColumns();

		$this->columns = array_filter( $this->columns );

		if ( empty( $this->ID ) ) {
			return $this->create();
		} else {
			return $this->update();
		}
	}

	/**
	 * @param $sql
	 *
	 * @return bool
	 */
	private function query( $sql ) {
		if ( $result = app::$conn->query( $sql ) === true ) {
			$this->updateColumns();

			return $result;
		} else {
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

		$sql .= implode( ",", array_keys( $this->columns ) );

		$sql .= ") VALUES (";

		$sql .= "'" . implode( "','", $this->columns ) . "'";

		$sql .= ")";

		if ( $result = $this->query( $sql ) ) {
			return $result;
		}

		app::$errors['db:create'] = "Error in creating {$this->class}: " . app::$conn->error;

		return false;
	}

	/**
	 * Updates a row in DB
	 *
	 * @return bool
	 */
	private function update() {
		// TODO: UPDATE EXISTING ROW
		$sql = "UPDATE {$this->tableName} SET ";

		$i = 0;

		foreach ( $this->columns as $column => $value ) {
			if ( ! empty( $value ) && $column != 'ID' ) {
				if ( $i != 0 ) {
					$sql .= ', ';
				}
				$sql .= "{$column}='{$value}'";
				$i ++;
			}
		}

		$sql .= " WHERE ID={$this->ID}";

		if ( $result = $this->query( $sql ) ) {
			return $result;
		}

		app::$errors['db:update'] = "Error in updating {$this->class}!";

		return false;
	}


	/**
	 * If query false, all rows selected, otherwise query will be run
	 *
	 * @param bool $query
	 * @param null $order
	 * @param null $sort
	 */
	private function select( $args = [], $query = "*" ) {

		$rtrn = [];
		// TODO: SELECT ROWS

		$query = implode( ",", array_keys( $this->columns ) );

		$sql   = "SELECT {$query} FROM {$this->tableName} ";


		foreach ( $args as $item ) {
			$sql .= "{$item} ";
		}

		$result = app::$conn->query( $sql );

		if ( $result->num_rows > 0 ) {
			// output data of each row
			while ( $row = $result->fetch_assoc() ) {
				$rtrn[] = new $this->class( $row );
			}
		} else {
			app::$errors['db:select'] = "No {$this->class} found.";
		}

		return $rtrn;
	}

	public function all() {
		return $this->select();
	}

	/**
	 * Selects single row in DB, based on ID
	 *
	 * @param int $id
	 */
	public function find( $id = 0 ) {
		return $this->where( [
			'WHERE ID=' . $id,
			'LIMIT 1'
		] );
	}

	public function where( $args = [] ) {
		if ( $result = $this->select( $args ) ) {
			return $result[0];
		}else return false;
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
	 * Searches DB for items equal or partially equal
	 *
	 * @param $str
	 */
	public function findByQuery( $sql = [] ) {
		// TODO: SELECT based on search string
	}

	/**
	 * Delete row
	 *
	 * @param int $id
	 */
	public function delete( $id = 0 ) {
		$id = $id == 0 ? $this->ID : $id;
		if ( $id ) {
			$sql = "DELETE FROM `{$this->tableName}` WHERE `ID`=$id";

			return $this->query( $sql );
		}

		app::$errors['db:delete'] = "Error in deleting file!";

		return false;
	}
}
