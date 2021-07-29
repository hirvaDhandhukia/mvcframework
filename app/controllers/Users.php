<?php
// BaseController.php file

// this page will take care of the flow of our application
// it gathers all the necessary data from the models and it will assign it to the view

class Users extends Controller {
	// constructor
	public function __construct() {
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

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
		}

		$this->view('users/register', $data);
	}

	public function login() {
		$data = [
			'title' => 'Login page',
			'usernameError' => '',
			'passwordError' => ''
		];

		$this->view('users/login', $data);
	}
}