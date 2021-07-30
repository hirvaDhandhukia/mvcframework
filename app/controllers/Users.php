<?php
// BaseController.php file

// this page will take care of the flow of our application
// it gathers all the necessary data from the models and it will assign it to the view

class Users extends Controller {
	// constructor
	public function __construct() {
		// creating a connection to database
		$this->userModel = $this->model('User');
	}

	// Method
	public function register() {
		$data = [
			'username' => '',
			'email' => '',
			'password' => '',
			'confirmPassword' => '',
			'usernameError' => '',
			'emailError' => '',
			'passwordError' => '',
			'confirmPasswordError' => ''
		];

		// checking if the request was a get or a post method
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'username' => trim($_POST['username']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirmPassword' => trim($_POST['confirmPassword']),
				'usernameError' => '',
				'emailError' => '',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];

			$nameValidation = "/^[a-zA-Z0-9]*$/";
			$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

			// Validate username on letters/numbers
			if(empty($data['username'])) {
				$data['usernameError'] = 'Please enter username.';
			} elseif (!preg_match($nameValidation, $data['username'])) {
				$data['usernameError'] = 'Name can only contain letters and numbers';
			}

			// Validaton of email
			if(empty($data['email'])) {
				$data['emailError'] = 'Please enter email address.';
			} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$data['emailError'] = 'Please enter a correct format of email';
			} else {
				// Check if email exists
				if($this->userModel->findUserByEmail($data['email'])) {
					$data['emailError'] = 'Email is already taken.';
				}
			}

			// Validation password 
			if(empty($data['password'])) {
				$data['passwordError'] = 'Please enter password.';
			} elseif (strlen($data['password']) < 4) {
				$data['passwordError'] = 'Password must be atleast 4 characters';
			} elseif (preg_match($passwordValidation, $data['password'])) {
				$data['passwordError'] = 'Password must be have atleast one numberic value.';
			}

			// Validation of confirm password
			if(empty($data['confirmPassword'])) {
				$data['confirmPasswordError'] = 'Please enter the same password again';
			} else {
				if($data['password'] != $data['confirmPassword']) {
					$data['confirmPasswordError'] = 'Passwords do not match, try again.';
				}
			}

			// check if all errors are empty before submitting the info
			if(empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

				// if errors are empty, then proceed
				// Hash password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				// Register the user from model function
				if($this->userModel->register($data)) {
					// redirect to login page
					header('location: ' . URLROOT . '/users/login');
				} else {
					die('Something went wrong');
				}
			}

		}

		$this->view('users/register', $data);
	}

	public function login() {
		$data = [
			'title' => 'Login page',
			'username' => '',
			'password' => '',
			'usernameError' => '',
			'passwordError' => ''
		];

		// check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		

		$data = [
			'username' => trim($_POST['username']),
			'password' => trim($_POST['password']),
			'usernameError' => '',
			'passwordError' => '',
		];

		// validate the username
		if (empty($data['username'])) {
			$data['usernameError'] = 'Please enter a username.';
		}

		//Validate password
		if (empty($data['password'])) {
			$data['passwordError'] = 'Please enter a password.';
		}

		// checking if all errors are empty
		if (empty($data['usernameError']) && empty($data['passwordError'])) {
			$loggedInUser = $this->userModel->login($data['username'], $data['password']);

			if($loggedInUser) {
				$this->createUserSession($loggedInUser);
			} else {
				$data['passwordError'] = 'Password or username is incorrect. Please try again';

				$this->view('users/login', $data);
			}
		}
		} else {
			$data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
		}

		$this->view('users/login', $data);
	}

	public function createUserSession($user) {
		$_SESSION['user_id'] = $user->id;
		$_SESSION['username'] = $user->username;
		$_SESSION['email'] = $user->email;
		header('location: '. URLROOT . '/pages/index');
	}

	public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }

}