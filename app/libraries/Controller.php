<?php

// here we initialize every class (every file) that is inside the 'controllers' folder

// loading the models and the views
class Controller {
	public function model($model) {
		// require mode file
		require_once '../app/models/' . $model . '.php';

		// instantiate a model
		return new $model();
	}

	// Load the view (checks for the file)
	public function view($view, $data = []) {
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once '../app/views/' . $view . '.php';
		} else {
			die("View/Page does not exists.");
		}
	}
}