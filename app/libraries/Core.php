<?php
// Core App class
// This class creates URL and loads core controller
class Core {
    // Properties
    // here the protected, public etc are called access modifiers
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    // Constructor
    // whenever the class Core is called, the constructor is runned
    public function __construct() {
        // print_r($this->getUrl());
        $url = $this->getUrl();
        
        // look inside the 'controllers' for first value, ucwords will capitilize first letter
        if(isset($url[0])) {
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // will set a new controller
            $this->currentController = ucwords($url[0]);
            // unset 0 index
            unset($url[0]);
            }
        }
            // require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';
            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // check for second part of url
            if(isset($url[1])) {
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // unset 1 index
                    unset($url[1]);
                }
            }

        // Get params
        // params property ne create kriu
        // '?' is a ternary operator
        // array_values is an inbuilt fn
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // Method
    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');

            //allows to filter variables as a string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);
            
            // breaking the string (url) into an array
            $url = explode('/', $url);
            return $url;
        }
    }
}