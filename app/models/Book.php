<?php
class Book {
    private $db;

    // everytime the Book class is called, this constructor will run
    public function __construct() {
        // we are making a connection with database by calling the class Database
        $this->db = new Database;
    }

    // our goal for this method to read all the posts from our database
    public function findAllBooks() {
        $this->db->query('SELECT * FROM books ORDER BY created_at DESC');

        // as there will be more than 1 books inside the database, i will use an associative array to access them easily
        $results = $this->db->resultSet();

        return $results;
    }
}