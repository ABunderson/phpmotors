<?php
//This is the Accounts controller


//start the session
session_start();

//Get the database connection file
require_once '../library/connections.php';

//Get the functions file
require_once '../library/functions.php';

//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the reviews model
require_once '../model/reviews-model.php';

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


switch ($action) {
    case "login":
        include '../view/login.php';
        break;
    case "registration":
        include '../view/registration.php';
        break;
    case "register":
        // Check to see if it works
        //echo "You are in the register case statement.";

        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
            // $message = '<p>Please provide information for all empty form fields.</p>';
            // include '../view/registration.php';
            $_SESSION['message'] = "<p class='bad'>Please provide information for all empty form fields.</p>";
            include "../view/registration.php";
            exit;
        }

        //validate email with function server side validation
        $clientEmail = checkEmail($clientEmail);
        // unvalid email message
        if ($clientEmail == '') {
            $_SESSION['message'] = "<p class='bad'>That email address is not valid.</p>";
            include "../view/registration.php";
            exit;
        }

        // Check for existing / duplicate email
        $existingEmail = checkExistingEmail($clientEmail);
        if ($existingEmail) {
            // $message = '<p>The email address already exists. Do you want to login instead?</p>';
            // include '../view/login.php';
            $_SESSION['message'] = "<p class='good'>The email address already exists. Do you want to login instead?</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        }

        //validate password format server side validation
        $checkPassword = checkPassword($clientPassword);
        if (!$checkPassword) {
            $_SESSION['message'] = "<p class='bad'>That is not a valide password. Please check the requirements and try again.</p>";
            include "../view/registration.php";
            exit;
        }

        //hash password 
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p class='good'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            //$message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            //include '../view/login.php';
            exit;
        } else {
            // $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            // include '../view/registration.php';
            $_SESSION['message'] = "<p class='bad'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include "../view/registration.php";
            exit;
        }
        break;
    case "Login":
        //check if works
        //echo "you are in the Login case statement";

        // Filter and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Check for missing data
        if (empty($clientEmail) || empty($clientPassword)) {
            // $message = '<p>Please provide information for all empty form fields.</p>';
            $_SESSION['message'] = "<p class='bad'>Please provide information for all empty form fields.</p>";
            include '../view/login.php';
            exit;
        }

        //validate email with function server side validation
        $clientEmail = checkEmail($clientEmail);
        // unvalid email message
        if ($clientEmail == '') {
            $_SESSION['message'] = "<p class='bad'>That email address is not valid.</p>";
            include "../view/login.php";
            exit;
        }

        //email address that does not exist
        // Check for existing / duplicate email
        $existingEmail = checkExistingEmail($clientEmail);
        if (!$existingEmail) {
            $_SESSION['message'] = "<p class='bad'>That email address is not in our system. Double check the email address or create a new account.</p>";
            include "../view/login.php";
            exit;
        }

        //validate password format server side validation
        $passwordCheck = checkPassword($clientPassword);

        if (!$passwordCheck) {
            $_SESSION['message'] = "<p class='bad'>That is not a valide password. Please check the requirements and try again.</p>";
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);

        //Compare submitted password hash with actual password hash
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        //If hashes don't match create an error and return to login view
        if (!$hashCheck) {
            // $message = '<p>Please check your password and try again.</p>';
            $_SESSION['message'] = "<p class='bad'>Please check your password and try again.</p>";
            include '../view/login.php';
            exit;
        }

        // If they exist log them in
        $_SESSION['loggedin'] = TRUE;

        //remove password hash from array
        array_pop($clientData);
        // print_r($clientData);


        //Store the array to the Session
        $_SESSION['clientData'] = $clientData;
        // echo $_SESSION['clientData']['clientId'];
        // exit;

        //send them to the admin view
        header('location: /phpmotors/accounts');
        break;
    case "logout":

        // print_r($_SESSION['clientData']);
        // echo '<br>';
        //session data unset
        unset($_SESSION['clientData']);
        // print_r($_SESSION['clientData']);


        //session destroyed
        $_SESSION = array();
        session_destroy();

        //return to main controller
        include '../index.php';

        break;
    case "update":
        include '../view/client-update.php';
        break;
    case "modAccount":
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = $_SESSION['clientData']['clientId'];

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            // $message = '<p>Please provide information for all empty form fields.</p>';
            // include '../view/registration.php';
            $_SESSION['message1'] = "<p class='bad'>Please provide information for all empty fields or leave the current values in.</p>";
            include '../view/client-update.php';
            exit;
        }

        //validate email with function server side validation
        $clientEmail = checkEmail($clientEmail);

        if ($clientEmail !== $_SESSION['clientData']['clientEmail']) {
            // unvalid email message
            if ($clientEmail == '') {
                $_SESSION['message1'] = "<p class='bad'>That email address is not valid.</p>";
                include '../view/client-update.php';
                exit;
            }

            // Check for existing / duplicate email
            $existingEmail = checkExistingEmail($clientEmail);
            if ($existingEmail) {
                // $message = '<p>The email address already exists. Do you want to login instead?</p>';
                // include '../view/login.php';
                $_SESSION['message1'] = "<p class='bad'>The email address is already being used by someone else.</p>";
                include '../view/client-update.php';
                exit;
            }
        }

        //Check if everything is the same
        if ($clientEmail === $_SESSION['clientData']['clientEmail'] && $clientFirstname === $_SESSION['clientData']['clientFirstname'] && $clientLastname === $_SESSION['clientData']['clientLastname']) {
            $_SESSION['message1'] = "<p class='bad'>Please change what you would like to update.</p>";
            include '../view/client-update.php';
            exit;
        }

        // Send the data to the model
        $modResult = modClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if ($modResult === 1) {
            // Query the client data based on the client id
            $clientData = getClientById($clientId);

            //remove password hash from array
            array_pop($clientData);
            // print_r($clientData);


            //Store the array to the Session
            $_SESSION['clientData'] = $clientData;

            $_SESSION['message'] = "<p class='good'>Successfully updated account!</p>";
        } else {
            $_SESSION['message'] = "<p class='bad'>Sorry $clientFirstname $clientLastname, but the Account update did not work.</p>";
        }

        include '../view/admin.php';
        break;
    case "modPassword":
        // echo "made it to the modify password case";
        // exit;
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = $_SESSION['clientData']['clientId'];

        // Check for missing data
        if (empty($clientPassword)) {
            // $message = '<p>Please provide information for all empty form fields.</p>';
            // include '../view/registration.php';
            $_SESSION['message2'] = "<p class='bad'>Enter the new password before clicking the button.</p>";
            include '../view/client-update.php';
            exit;
        }

        //validate password format server side validation
        $checkPassword = checkPassword($clientPassword);

        if (!$checkPassword) {
            $_SESSION['message2'] = "<p class='bad'>That is not a valide password. Please check the requirements and try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        //hash password 
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $modPasswordResult = modPassword($hashedPassword, $clientId);

        // Check and report the result
        if ($modPasswordResult === 1) {

            $_SESSION['message'] = "<p class='good'>Successfully updated password!</p>";
        } else {
            $_SESSION['message'] = "<p class='bad'>Sorry $clientFirstname $clientLastname, but the password update did not work.</p>";
        }

        include '../view/admin.php';
        break;
    default:
        if ($_SESSION['clientData']['clientLevel'] > 1) {
            $adminTools = buildAdminTools();
        }
        $reviews = getClientReviews($_SESSION['clientData']['clientId']);
        // print_r($reviews);
        // exit;
        if (count($reviews) > 0) {
            $adminReviewList = buildReviewList($reviews);
        } else {
            $_SESSION['message1'] = '<p>No reviews have been written.</p>';
        }

        include '../view/admin.php';
}
