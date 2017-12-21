<?php

require_once PATH_DB . 'Database.class.php';
require_once PATH_LIB . 'Person.class.php';

// handle get/set and db access
class PersonEntity extends Person {
	const TABLE = 'PERSON';

	protected $db;
	protected $row_id;

	/**
	 * Entity constructors
	 *
	 * @param $row_id - if dealing with existing row in the db
	 */

	/*
	public function __construct() {
		$this->row_id = null;

		$config = $GLOBALS['config'];
		$this->db = new Database($config);
	}
	 */

	public function __construct($lastname, $weight, $height) {
		parent::__construct($lastname, $weight, $height);

		$this->row_id = null;

		$config = $GLOBALS['config'];
		$this->db = new Database($config);
	}

	/*
	public function __construct($row_id) {
		$config = $GLOBALS['config'];
		$this->db = new Database($config);
	}
	 */

	public function get_lastname() {
		return $this->lastname;
	}
	public function set_lastname($lastname) {
		$this->lastname = $lastname;
	}

	public function get_height() {
		return $this->height;
	}
	public function set_height($height) {
		$this->height = $height;
	}

	public function get_weight() {
		return $this->weight;
	}
	public function set_weight($weight) {
		$this->weight = $weight;
	}

	/**
	 * standalone function to query all rows in person table
	 *
	 * @param
	 * @return array - controllers are not involved with mysqli functions
	 */
	public function all() {
		$query = "SELECT * FROM " . self::TABLE;
		$res = $this->db->query($query);

		$persons = [];
		while ($row = mysqli_fetch_row($res)) {
			//print_r($row);
			$persons[] = [
				'row_id' => $row[0],
				'lastname' => $row[1],
				'weight' => $row[2],
				'height' => $row[3]
			];
		}
		return $persons;
	}

	/**
	 * check if row exist in the db
	 *
	 * @param
	 * @return
	 */
	public function exist() {
		return ($this->row_id != null);
	}

	/**
	 * load an existing row in the db to form a Person obj
	 *
	 * @param $row_id
	 * @return null
	 */
	public function load_by_id($row_id) {
		$this->row_id = $row_id;

		$query = "SELECT * FROM " . self::TABLE . " WHERE id = " . $row_id;
		//echo $query;

		// TODO: need a fail check
		// run query
		$res = $this->db->query($query);

		// repopulate values lastname, weight, height
		$fetch_person = mysqli_fetch_row($res);
		//print_r($fetch_person);
		// multiple columns would need a mapping array of fieldname to array indices
		$this->set_lastname($fetch_person[1]);
		$this->set_weight($fetch_person[2]);
		$this->set_height($fetch_person[3]);
	}

	/**
	 * insert new row into the db or
	 * edit the existing row
	 *
	 * @param
	 * @return row id
	 */
	public function save() {
		$e = $this->exist();
		if (!$e) { // insert
			$query = "INSERT INTO " . self::TABLE . " VALUES (" .
				"NULL" . ", " .
				"'" . $this->lastname . "', " .
				$this->weight . ", " .
				$this->height . ");";
			//echo $query;

			// run query
			$res = $this->db->query($query);

			// second query select increment values for return
			$query_id = "SELECT LAST_INSERT_ID()";
			$res = $this->db->query($query_id);
			//echo "[id]" . mysql_result($res, 0);
			//return mysql_result($res, 0); // deprecated function

			//echo "[id]";
			//print_r(mysqli_fetch_row($res));
			$fetch_id = mysqli_fetch_row($res)[0];
			return $fetch_id;
		}
		else { // update
			$query = "UPDATE " . self::TABLE . " SET " .
				"lastname = '" . $this->lastname . "', " .
				"weight = " . $this->weight . ", " .
				"height = " . $this->height . " WHERE id = " . $this->row_id;
			//echo $query;

			// run query
			$res = $this->db->query($query);

			// return row id
			return $this->row_id;
		}
	}

	/**
	 * delete row if exist
	 *
	 * @param
	 * @return query resource (1 = success)
	 */
	public function delete() {
		$e = $this->exist();
		if ($e) {
			$query = "DELETE FROM " . self::TABLE . " WHERE id = " . $this->row_id;

			//echo $query;
			// run query
			$res = $this->db->query($query);
			return $res;
		}
	}
}

?>
