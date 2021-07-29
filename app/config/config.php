<?php
// database params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mvcframework');


// APPROOT
define('APPROOT', dirname(dirname(__FILE__)));

// URLROOT (Dynamic links)
define('URLROOT', 'http://localhost/mvcframework');

// Sitename
define('SITENAME', 'MVC Framework');

// here __FILE__ gives the whole path of the particular file we are in; here if we write echo __FILE__ then, output will be :- C:\xampp\htdocs\mvcframework\app\config\config.php
// inside APPROOT we want our url until \app. so we use inbuilt fn dirname to remove the last 2 configs from the url

// inside URLROOT, we need our path. i.e. localhost/mvcframework

