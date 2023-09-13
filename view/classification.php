<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title><?php echo $classificationName; ?> vehicles | PHP Motors</title>

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

            <h1><?php echo $classificationName; ?> Vehicles</h1>

            <?php
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <?php
                if (isset($vehicleDisplay)) {
                    echo $vehicleDisplay;
                }
            ?>

        </main>

        <hr>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php' ?>
        </footer>

    </div> <!-- wrapper ends -->

</body>

</html>

<?php
unset($_SESSION['message']);

?>