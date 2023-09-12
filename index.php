<?php
//This is the main controller for the site


//start the session
session_start();

//Get the database connection file
require_once 'library/connections.php';

//Get the functions file
require_once 'library/functions.php';

//Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

// // Check if firstname cookie exists, get its value
// if(isset($_COOKIE['firstname'])){
//     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// }

//Get the array of classifications
$classifications = getClassifications();
//Check database connection
//var_dump($classifications);
//    exit;

//make the navigation bar with a function
$navList = createNav(getClassifications());

$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if ($action == NULL) {
    $action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}

switch ($action){
    default:
        include 'view/home.php';
}


?>