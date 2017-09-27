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

	public $errors = [];
	private $noUse = [ 'hidden', 'tableName', 'columns', 'errors', 'noUse' ];

	/**
	 * Loads when DataBase class initialised
	 * DataBase constructor.
	 */
	public function __construct() {
		$this->tableName = strtolower( get_class( $this ) ) . "s";
		$this->updateColumns();
	}

	private function updateColumns (){

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

		$this->columns = array_filter($this->columns);

		if ( empty($this->ID) ) {
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
            echo "im here<br>";
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

		$sql .= implode( ",", array_keys( $this->columns ) );

		$sql .= ") VALUES (";

		$sql .= "'" . implode( "','", $this->columns ) . "'";

		$sql .= ")";

		return $this->query( $sql );
	}

	/**
	 * Updates a row in DB
	 *
	 * @return bool
	 */
	private function update( ) {
        // TODO: UPDATE EXISTING ROW
        $sql = "UPDATE {$this->tableName} SET ";

        $i = 0;

        foreach ($this->columns as $column => $value) {
                if (!empty($value) && $column != 'ID') {
                    if($i != 0) $sql .= ', ';
                    $sql .= "{$column}='{$value}'";
                    $i++;
                }
        }

        $sql .= " WHERE ID={$this->ID}";

        return $this->query( $sql );
    }


	/**
	 * If query false, all rows selected, otherwise query will be run
	 *
	 * @param bool $query
	 * @param null $order
	 * @param null $sort
	 */
	private function select( $query = '*', $args = [] ) {

	    $className = get_class($this);
		// TODO: SELECT ROWS{

        $sql = "SELECT {$query} FROM {$this->tableName} ";

        foreach ($args as $item) {
            $sql .= "{$item} ";
        }

        $result = app::$conn->query( $sql );

        if ($result->num_rows > 0) {
	        $rtrn = [];
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $rtrn[] = new $className($row);
            }

	        return $rtrn;
        } else {
            echo "0 results";
        }
	}

	public function all (){
	    return $this->select();
    }

	/**
	 * Selects single row in DB, based on ID
	 *
	 * @param int $id
	 */
	public function find( $id = 0 ) {

        $className = get_class($this);
		// TODO: SELECT single row
        return $this->select('*', [
            'WHERE ID=' . $id,
            'LIMIT 1'
        ])[0];
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
        $sql = "DELETE FROM {$this->tableName} WHERE ID = $id";

        return $this->query( $sql );
	}
}
