<?php

class Database {
	// here we are creating a connection with the database
	private $dbHost = DB_HOST;
	private $dbUser = DB_USER;
	private $dbPass = DB_PASS;
	private $dbName = DB_NAME;

	// while preparing the statement, we will use these properties below
	private $statement;
	private $dbHandler;
	private $error;

	// Constructor
	public function __construct() {
		$conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		try {
			// let's instanciate the PDO class
			// PDO class ni andar p4 variables initiate krva pade. 1st is the connection, 2nd is user nane, 3rd is passsword, 4th is the $options variable which creates a persistent connection with database and states the errors inside our catch 
			$this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	// Methods
	// Allows us to write queries
	public function query($sql) {
		$this->statement = $this->dbHandler->prepare($sql);
	}

	// Bind params
	public function bind($parameter, $value, $type = null) {
		switch (is_null($type)) {
			case is_int($value):
				$type = PDO::PARAM_INT;
				break;
			case is_bool($value):
				$type = PDO::PARAM_BOOL;
				break;
			case is_null($value):
				$type = PDO::PARAM_NULL;
				break;
			default:
				$type = PDO::PARAM_STR;
		}
		$this->statement->bindValue($parameter, $value, $type);
	}

	// Execute the prepared statement
	public function execute() {
		return $this->statement->execute();
	}

	// Return an array
	public function resultSet() {
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_OBJ);
	}

	// Return a specific row as an object
	public function single() {
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_OBJ);
	}

	// Get's the row count
	public function rowCount() {
		return $this->statement->rowCount();
	}
}