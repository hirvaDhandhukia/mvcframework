<?php

// Model.php file

class User {
	private $db;

	// Constructor
	public function __construct() {
		$this->db = new Database;
	}

	// to register a new user inside the database
	public function register($data) {
		$this->db->query('INSERT INTO users (username, email, password) VALUE (:username, :email, :password)');

		// now bind the values
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		// now execute the function\
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	// to login a user inside the website
	public function login($username, $password) {
		// using a prepared statement 
		$this->db->query('SELECT * FROM users WHERE username = :username');

		// binding the value
		$this->db->bind(':username', $username);
		
		$row = $this->db->single();

		$hashdPassword = $row->password;
		if(password_verify($password, $hashdPassword)) {
			return $row;
		} else {
			return false;
		}
	}

	// Finding the user by email. Email is passed in by the controller
	public function findUserByEmail($email) {
		// Prepared statement
		$this->db->query('SELECT * FROM users WHERE email :email');

		// email param will be binded with the email variable
		$this->db->bind(':email', $email);

		// check if email is already registered
		// Database.php ma already ek method named rowCount che. here we are using the same method 
		if($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// Methods
	/* Test
	public function getUsers() {
		$this->db->query("SELECT * FROM users");
		$result = $this->db->resultSet();
		return $result;
	} */
}

// here, models has user (singular) and controllers has users (plural)