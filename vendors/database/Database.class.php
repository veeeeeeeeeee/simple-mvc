<?php

class Database {
	protected $conn = false;
	protected $stmt;

	public function __construct($config) {
		$args = [
			'host' => $config['host'],
			'port' => $config['port'],
			'dbuser' => $config['dbuser'],
			'password' => $config['password'],
			'dbname' => $config['dbname']
		];

		//$this->conn = mysql_connect($args['host'] . ':' . $args['port'], $args['dbuser'], $args['password']); // deprecated
		//mysql_select_db($args['dbname']);
		$this->conn = new mysqli($args['host'] . ':' . $args['port'], $args['dbuser'], $args['password'], $args['dbname']);
	}

	public function query($stmt) {
		$this->stmt = $stmt;

		// SQL injection alert
		//$res = mysql_query($this->stmt, $this->conn); // deprecated function
		$res = $this->conn->query($stmt);
		return $res;
	}
}
?>
