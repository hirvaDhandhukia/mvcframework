<?php

class User {
	private $db;

	// Constructor
	public function __construct() {
		$this->db = new Database;
	}

	// Methods
	/* Test
	public function getUsers() {
		$this->db->query("SELECT * FROM users");
		$result = $this->db->resultSet();
		return $result;
	} */

	
}