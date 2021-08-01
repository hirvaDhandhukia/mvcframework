<?php

// controller defines the model and view so that we can use them inside our files of contrllers folder
class Books extends Controller {
    public function __construct() {
        // calling the Book file inside the model folder
        $this->bookModel = $this->model('Book');
    }

    // defining a view here
    public function index() {
        $books = $this->bookModel->findAllBooks();
        // var_dump($books);
        // we need to pass in our book to our view
        $data = [
            'books' => $books
        ];
        $this->view('books/index', $data);
    }
}