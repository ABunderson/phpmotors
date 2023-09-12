<?php
//Check if logged in and has a clientLevel greater than 1 if not return to home page
if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title>Vehicle Management | PHP Motors</title>

</head>

<body>
    <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php' ?>
        </header>
        <nav>
            <?php
            //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/navigation.php' 
            echo $navList;
            ?>
        </nav>
        <main>
            <h1>Vehicle Management</h1>

            <ul>
                <li>
                    <a href='/phpmotors/vehicles/index.php?action=newClassification' title='Add a classification' id="newClassification">Add Classification</a>
                </li>
                <li>
                    <a href='/phpmotors/vehicles/index.php?action=newVehicle' title='Add a vehicle' id="newVehicle">Add Vehicle</a>
                </li>
            </ul>

            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($classificationList)) {
                echo '<h2>Vehicles By Classification</h2>';
                echo '<p>Choose a classification to see those vehicles</p>';
                echo $classificationList;
            }

            ?>

            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <!-- Create the table for the Javascript to insert into -->
            <table id="inventoryDisplay"></table>

        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php' ?>
        </footer>
    </div> <!-- wrapper ends -->

    <script src="../js/inventory.js"></script>
</body>

</html>
<?php
unset($_SESSION['message']);
?>