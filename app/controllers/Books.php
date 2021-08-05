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

    public function create() {
        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/books");
        }
        $data = [
            'title' => '',
            'body' => '',
            'price' => '',
            'titleError' => '',
            'bodyError' => '',
            'priceError' => ''
        ];

        // checking if the server request method is post or not
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // we now sanitize the form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'price' => trim($_POST['price']),
                'titleError' => '',
                'bodyError' => '',
                'priceError' => ''
            ];
            // var_dump($data['body']);

            if(empty($data['title'])) {
                $data['titleError'] = 'Title of a book cannot be empty';
            }
            if(empty($data['body'])) {
                $data['bodyError'] = 'Description of a book cannot be empty';
            }

            if(empty($data['titleError']) && empty($data['bodyError']) && empty($data['priceError'])) {
                if($this->bookModel->addBook($data)) {
                    header("Location: " . URLROOT . "/books");
                } else {
                    die("Something went wrong. Try again");
                }
            } else {
                $this->view('books/create', $data);
            }
        }
        $this->view('books/create', $data);
    }

    public function update($id) {
        $book = $this->bookModel->findBookById($id);
        // var_dump($book);

        if(!isLoggedIn()) {
            // this /books is to show that a user can edit only his posts
            header("Location: " . URLROOT . "/books");
        } elseif ($book->user_id != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/books");
        }

        $data = [
            'book' => $book,
            'title' => '',
            'body' => '',
            'price' => '',
            'titleError' => '',
            'bodyError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // we now sanitize the form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'book' => $book,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'price' => trim($_POST['price']),
                'titleError' => '',
                'bodyError' => '',
                'priceError' => ''
            ];
            // var_dump($data['body']);

            if(empty($data['title'])) {
                $data['titleError'] = 'Title of a book cannot be empty';
            }
            if(empty($data['body'])) {
                $data['bodyError'] = 'Description of a book cannot be empty';
            }

            // checking if the submitted fields are same as the database values or not
            if($data['title'] == $this->bookModel->findBookById($id)->title) {
                $data['titleError'] = 'At least change the title!';
            }
            if($data['body'] == $this->bookModel->findBookById($id)->body) {
                $data['bodyError'] = 'At least change the body!';
            }
            if($data['price'] == $this->bookModel->findBookById($id)->price) {
                $data['priceError'] = 'At least change the price!';
            }

            if(empty($data['titleError']) && empty($data['bodyError']) && empty($data['priceError'])) {
                if($this->bookModel->updateBook($data)) {
                    header("Location: " . URLROOT . "/books");
                } else {
                    die("Something went wrong. Try again");
                }
            } else {
                $this->view('books/update', $data);
            }
        }
        $this->view('books/update', $data);
    }

    public function delete($id) {
        $book = $this->bookModel->findBookById($id);
        // var_dump($book);

        if(!isLoggedIn()) {
            // this /books is to show that a user can edit only his posts
            header("Location: " . URLROOT . "/books");
        } elseif ($book->user_id != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/books");
        }

        $data = [
            'book' => $book,
            'title' => '',
            'body' => '',
            'price' => '',
            'titleError' => '',
            'bodyError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->bookModel->deleteBook($id)) {
                header("Location: " . URLROOT . "/books");
            } else {
                die("Error occured");
            }
        }
    }

    public function purchase($id) {
        // echo "hi";
        $book = $this->bookModel->findBookById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/books");
        }
        $data = [
            'book' => $book,
            'user_id' => ''
        ];

        // checking if the server request method is post or not
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // we now sanitize the form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'book' => $id
            ];
            // var_dump($data['book']);

            if($this->bookModel->purchaseBook($data)) {
                header("Location: " . URLROOT . "/books");
            } else {
                die("Error occured");
            }
        }
        // $this->view('books/create', $data);
    }
}