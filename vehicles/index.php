<?php
//This is the Vehicles controller


//start the session
session_start();

//Get the database connection file
require_once '../library/connections.php';

//Get the functions file
require_once '../library/functions.php';

//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the uploads model
require_once '../model/uploads-model.php';

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

    case "newClassification":
        include '../view/new-classification.php';
        break;
    case "newVehicle":
        include '../view/new-vehicle.php';
        break;
    case "addClassification":
        //Check to see if it got to the right case
        //echo "reached the case statement";

        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        //check
        //echo "$classificationName";
        //exit;

        //server validate length of classification name
        $checkClassification = checkClassification($classificationName);

        // Check for missing data
        if (empty($classificationName)) {
            $message = "<p class='bad'>Please provide information for all empty form fields.</p>";
            include '../view/new-classification.php';
            exit;
        } elseif (empty($checkClassification)) {
            $message = "<p class='bad'>That name is too long. Please try again.</p>";
            include '../view/new-classification.php';
            exit;
        }

        // Send the data to the model
        $newClassificationOutcome = newClassification($classificationName);

        // Check and report the result
        if ($newClassificationOutcome === 1) {
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p class='bad'>Sorry, but adding a new car classification failed. Please try again.</p>";
            include '../view/new-classification.php';
            exit;
        }

        break;
    case "addVehicle":
        //echo "entered the add vehicle switch case";
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        //check
        //echo "$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId";

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = "<p class='bad'>Please provide information for all empty form fields and make sure a car classification is chosen.</p>";
            include '../view/new-vehicle.php';
            exit;
        }

        // Send the data to the model
        $newVehicleOutcome = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report the result
        if ($newVehicleOutcome === 1) {
            $message = "<p class='good'>A new vehicle has been successfully added!</p>";
            include '../view/new-vehicle.php';
            exit;
        } else {
            $message = "<p class='bad'>Sorry, but adding a new car classification failed. Please try again.</p>";
            include '../view/new-vehicle.php';
            exit;
        }

        break;
    case "getInventoryItems":

        // get classificationId
        $classificationId = trim(filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

        // Fetch the vehicles by classificationId from the DB
        $inventoryArray = getInventoryByClassification($classificationId);

        //convert the arry to a JSON object and send it back
        echo json_encode($inventoryArray);

        break;
    case "mod":
        $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT));
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = "<p class='bad'>Sorry, no vehicle information could be found.</p>";
        }
        include '../view/vehicle-update.php';
        exit;

        break;
    case "del":
        $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT));
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = "<p class='bad'>Sorry, no vehicle information could be found.</p>";
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case "updateVehicle":
        // echo "entered the update vehicle switch case";
        // exit;
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        //check
        //echo "$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId";

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = "<p class='bad'>Please provide information for all empty form fields and make sure a car classification is chosen.</p>";
            include '../view/vehicle-update.php';
            exit;
        }

        // Send the data to the model
        $updateVehicleOutcome = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        //echo $updateVehicleOutcome;


        // Check and report the result
        if ($updateVehicleOutcome === 1) {
            $message = "<p class='good'>$invMake $invModel has been updated successfully!</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='bad'>Sorry, but updating $invMake $invModel failed. Please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case "deleteVehicle":
        // echo "entered the delete vehicle switch case";
        // exit;
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        //check
        //echo "$invMake, $invModel";

        // Send the data to the model
        $deleteVehicleOutcome = deleteVehicle($invId);
        //echo $deleteVehicleOutcome;


        // Check and report the result
        if ($deleteVehicleOutcome) {
            $message = "<p class='good'>Vehicle $invMake $invModel has been deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='bad'>Sorry, but deleting $invMake $invModel failed. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case "classification":
        $classificationName = trim(filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehicles = getVehiclesByClassification($classificationName);

        //check if there are any vehicles returned
        if (!count($vehicles)) {
            $message = "<p class='bad'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        // echo $vehicleDisplay;
        // exit;

        include '../view/classification.php';
        break;
    case "information":
        $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $vehicleInfo = getVehicleDetail($invId);
        //get review info based on vehicle invId
        $reviews = getItemReviews($invId);
        $allThumbnails = getThumbnails($invId);

        // check if there any information is returned
        if (count($vehicleInfo) < 1) {
            $message = "<p class='bad'>Sorry, no vehicle information could be found.</p>";
        } else {
            $ThumbnailDisplay = buildThumbnailDisplay($allThumbnails);
            $vehicleInfoDisplay = buildVehicleInfo($vehicleInfo);
            // check for reviews and return if found
            if (count($reviews) > 0) {
                $reviewDisplay = buildReviewDisplay($reviews);
            } else {
                $_SESSION['message2'] = '<p>Be the first to review!</p>';
            }
        }

        if (!isset($_SESSION['loggedin'])) {
            $_SESSION['header'] = '<h2>You must <u><a href="../accounts/index.php?action=login">login</a></u> to write a review</h2>';
        } else {
            $_SESSION['header'] = "<h2>Review the $vehicleInfo[invMake] $vehicleInfo[invModel]</h2>";            
            $reviewForm = buildReviewForm($_SESSION['clientData'], $vehicleInfo);
        }
        
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);


        include '../view/vehicle-management.php';
}
