<?php

//This is the Reviews controller


//start the session
session_start();

//Get the database connection file
require_once '../library/connections.php';

//Get the functions file
require_once '../library/functions.php';

//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

//Get the reviews model
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
    case 'newReview':
        //process of adding a new review

        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        // Check for missing data
        if (empty($reviewText)) {
            $_SESSION['message1'] = "<p class='bad'>Please write the review before submitting.</p>";
            // $message = '<p>Please provide information for all empty form fields.</p>';
            header("Location: /phpmotors/vehicles/?action=information&invId=$invId");
            exit;
        }


        // Send the data to the model
        $addReviewOutcome = addReview($reviewText, $invId, $clientId);

        // Check and report the result
        if ($addReviewOutcome === 1) {
            $_SESSION['message1'] = "<p class='good'>Thanks for adding a review.</p>";
            header("Location: /phpmotors/vehicles/?action=information&invId=$invId");
            exit;
        } else {
            $_SESSION['message1'] = "<p class='bad'>Sorry, adding a review failed. Please try again.</p>";
            header("Location: /phpmotors/vehicles/?action=information&invId=$invId");
            exit;
        }

        break;
    case 'editReview':
        //deliver view to edit review
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT));
        $reviewInfo = getReview($reviewId);
        $date = formatDate($reviewInfo['reviewDate']);


        if (count($reviewInfo) < 1) {
            $message = "<p class='bad'>Sorry, no review information could be found.</p>";
            $_SESSION['message'] = $message;
        }

        include '../view/review-update.php';
        break;
    case 'updateReview':
        //process of updating review
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewInfo = getReview($reviewId);

        if (!isset($reviewId)) {
            $message = "<p class='bad'>Sorry, no review information could be found.</p>";
            $_SESSION['message'] = $message;
        }

        // Check for missing data
        if (empty($reviewText)) {
            $_SESSION['message'] = "<p class='bad'>An empty review cannot be submitted. Please edit the review before submitting.</p>";
            // $message = '<p>Please provide information for all empty form fields.</p>';
            // header("Location: /phpmotors/vehicles/?action=information&invId=$reviewId");
            header("location: ../reviews/index.php?action=editReview&reviewId=$reviewId");
            exit;
        }

        //Check for changes
        if ($reviewText === $reviewInfo['reviewText']){
            $_SESSION['message'] = "<p class='bad'>Please change the review before trying to update.</p>";
            header("location: ../reviews/index.php?action=editReview&reviewId=$reviewId");
            exit;
        }

        // send the data to the model
        $updateReviewOutcome = updateReview($reviewId, $reviewText);

        // Check and report the result
        if ($updateReviewOutcome === 1) {
            $message = "<p class='good'>Your review has been updated successfully!</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        } else {
            $message = "<p class='bad'>Sorry, but updating review failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header("location: ../reviews/index.php?action=editReview&reviewId=$reviewId");
            exit;
        }

        break;
    case 'deleteReview':
        //deliver view to confirm deletion
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT));
        $reviewInfo = getReview($reviewId);
        $date = formatDate($reviewInfo['reviewDate']);

        if (count($reviewInfo) < 1) {
            $message = "<p class='bad'>Sorry, no review information could be found.</p>";
            $_SESSION['message'] = $message;
        }

        include '../view/review-delete.php';
        break;
    case 'deletionReview':
        //process of deleting review
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

        if (!isset($reviewId)) {
            $message = "<p class='bad'>Sorry, no review information could be found.</p>";
            $_SESSION['message'] = $message;
        }

        // Send the data to the model
        $deleteReviewOutcome = deleteReview($reviewId);

        // Check and report the result
        if ($deleteReviewOutcome) {
            $message = "<p class='good'>The review has been deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        } else {
            $message = "<p class='bad'>Sorry, but deleting the review failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header("location: ../reviews/index.php?action=deleteReview&reviewId=$reviewId");
            exit;
        }

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
        }
        include '../view/admin.php';
}
