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

    public function addBook($data) {
        $this->db->query('INSERT INTO books (user_id, title, body, price) VALUES (:user_id, :title, :body, :price)');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':price', $data['price']);

        // after binding the params, we need to execute this
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findBookById($id) {
        $this->db->query('SELECT * FROM books WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function updateBook($data) {
        $this->db->query('UPDATE books SET title = :title, body = :body, price = :price WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':price', $data['price']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBook($id) {
        $this->db->query('DELETE FROM books WHERE id = :id');

        $this->db->bind(':id', $id);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}