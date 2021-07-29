<?php

// PageController.php

// Controller/php ni andar 2 methods initiate kria ta apde, one for connection wth models and one for connection wth views; So when we 'extends' the 'Controller' class, both of those methods will be now accessible by our controllers/Pages.php also

// also, inside the Core.php we defined the Pages.php as default controller and index as the default method

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
		// Controller class na 'view' naam na method ne call kriu aia
		// and views file ni andar ni index file ne call karaviu
		$this->view('pages/index', $data);
	}

	public function about() {
		$this->view('pages/about');
	}
}