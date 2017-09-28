<?php

/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 25/09/2017
 * Time: 12.09
 */
class DataBase {
	protected $hidden = [];
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

	private function errors( $sql, $result ) {
		if ( ! $result ) {
			app::$errors['db']['msg'] = "DataBase error: " . app::$conn->error;
			app::$errors['db']['sql'] = $sql;
		} else {
			app::$errors['db']['msg'] = "No {$this->class} found!";
		}
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
			$this->ID = app::$conn->insert_id;

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

		app::$errors['db:update'] = "Error in updating {$this->class}: " . app::$conn->error;

		return false;
	}


	/**
	 * If query false, all rows selected, otherwise query will be run
	 *
	 * @param bool $query
	 * @param null $order
	 * @param null $sort
	 */
	private function select( $args = [], $query = null ) {

		$rtrn = [];

		$cols = [];
		if ( count( $this->hidden ) !== 0 && ! isset( $args['hidden'] ) ) {
			foreach ( $this->columns as $column => $val ) {
				if ( ! in_array( $column, $this->hidden ) ) {
					$cols[ $column ] = $val;
				}
			}
		} else {
			$cols = $this->columns;
		}

		$query = is_null( $query ) ? implode( ",", array_keys( $cols ) ) : $query;

		$sql = "SELECT {$query} FROM {$this->tableName} ";

		foreach ( $args as $key => $item ) {
			$sql .= "{$item} ";
		}

		$result = app::$conn->query( $sql );

		return self::getResult( $result, $sql );
	}

	public function all() {
		return $this->select();
	}

	public function with() {
		echo "with";
	}

	public function orderBy( $by = "" ) {
		return $this->where( [ 'ORDER BY ' . $by ] );
	}

	/**
	 * Selects single row in DB, based on ID
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function findById( $id = 0 ) {
		return $this->where( [
			'WHERE ID=' . $id,
			'LIMIT 1'
		] )[0];
	}

	public static function find( $id = 0 ) {
		$class = get_called_class();


		return ( new $class() )->findById( $id );
	}

	public function single( $args = [], $query = null ) {
		return $this->where( $args, $query )[0];
	}

	public static function selectStatic( $args ) {
		$class     = get_called_class();
		$classVars = get_class_vars( $class );
		$tableName = strtolower( $class ) . 's';
		$rm        = array_merge( $classVars['hidden'], $classVars['noUse'] );
		$rtrn      = [];

		$props = [];

		foreach ( $classVars as $key => $classVar ) {
			if ( ! in_array( $key, $rm ) ) {
				$props[] = $key;
			}
		}

		$selection = implode( ',', $props );

		$sql = "SELECT {$selection} FROM {$tableName}";

		$orderBy = isset( $args['order'] ) ? " ORDER BY {$args['order']}" : '';

		unset( $args['order'] );

		for ( $i = 0; $i < count( $args ); $i ++ ) {
			$sql .= $i == 0 ? " WHERE " : " AND ";

			$sql .= "{$args[$i][0]}{$args[$i][1]}'{$args[$i][2]}'";
		}


		$result = app::$conn->query( $sql . $orderBy );

		if ( $result && $result->num_rows > 0 ) {
			// output data of each row
			while ( $row = $result->fetch_assoc() ) {
				$rtrn[] = new $class( $row );
			}
		}

		return $rtrn;
	}

	public static function get( $args = [] ) {
		if ( $result = self::selectStatic( $args ) ) {
			return $result;
		} else {
			return [];
		}
	}

	public function where( $args = [], $query = null ) {
		if ( $result = $this->select( $args, $query ) ) {


			return $result;
		} else {
			return [];
		}
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
	public function findByQuery( $sql ) {

		$result = app::$conn->query( $sql );

		return $this->getResult( $result, $sql, false );

	}

	/**
	 * Delete row
	 *
	 * @param int $id
	 * @param string $where
	 *
	 * @return bool
	 */
	public static function delete( $id = 0, $where = "ID" ) {
		if ( $id ) {
			$tableName = strtolower( get_called_class() ) . 's';

			$sql = "DELETE FROM `{$tableName}` WHERE `{$where}`={$id}";

			if ( $result = app::$conn->query( $sql ) === true ) {
				return $result;
			} else {

				app::$errors['db:delete'] = "Error in deleting file: " . app::$conn->error;

				return false;
			}
		}

		return false;
	}

	public function destroy( $args ) {
		$tableName = strtolower( get_called_class() ) . 's';

		$sql = "DELETE FROM `{$tableName}` ";



		for ( $i = 0; $i < count( $args ); $i ++ ) {
			$sql .= $i == 0 ? " WHERE " : " AND ";

			$sql .= "{$args[$i][0]}{$args[$i][1]}'{$args[$i][2]}'";
		}

		if ( $result = app::$conn->query( $sql ) === true ) {
			return $result;
		} else {

			app::$errors['db:delete'] = "Error in deleting file: " . app::$conn->error;

			return false;
		}
	}

	/**
	 * @param $result
	 * @param $rtrn
	 * @param $sql
	 *
	 * @return array
	 */
	private function getResult( $result, $sql, $withClass = true ) {
		if ( $result && $result->num_rows > 0 ) {
			$rtrn = [];
			// output data of each row
			while ( $row = $result->fetch_assoc() ) {
				$rtrn[] = $withClass ? new $this->class( $row ) : $row;
			}

			return $rtrn;
		} else {
			$this->errors( $sql, $result );
		}

		return [];
	}


}
