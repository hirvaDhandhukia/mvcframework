<?php

class Pages extends Controller {
	// Constructor
	public function __construct() {
		// $this->userModel = $this->model('User');
	}

	// Method
	public function index() {
		// $users = $this->userModel->getUsers();
		// making an associative array called $data
		$data = [
			'title' => 'Home page'
			// 'users' => $users
		];
		$this->view('pages/index', $data);
	}

	public function about() {
		$this->view('pages/about');
	}
}