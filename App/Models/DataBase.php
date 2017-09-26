<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 25/09/2017
 * Time: 12.09
 */
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
	protected $columns = [];

	/**
	 * Loads when DataBase class initialised
	 * DataBase constructor.
	 */
	public function __construct() {
<<<<<<< HEAD

		echo "<pre>";
		print_r(app::$db);
		echo "<";
		$sql = "INSERT INTO users (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";

		if (app::$db->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . app::$db->error;
		}

=======
		$this->connection = Connection::open();
                $this->tableName = strtolower(get_class ([ $this ] )) ."s";
                
                $this->columns = (get_object_vars ([ $this ] ));
               
                echo "<pre>";
                
                print_r ($this->columns);
                
                echo "</pre>";
                
	}

	/**
	 * Loads when DataBase class unlinked
	 */
	public function __destruct() {
		// TODO: Close DB connection
		$this->connection = Connection::close();
>>>>>>> 5037a9fe1b8b1ab2f21e3871e151b2832581a58a
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
	private function create($values) {
		// TODO: INSERT NEW ROW
            $sql = "INSERT INTO $this->tablename";
            
            
            
            $ResultSet = connection()->query($sql); 
            return $ResultSet;
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
