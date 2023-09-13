<?php
    if (isset($_SESSION['message1'])) {
        $message1 = $_SESSION['message1'];
    }
    if (isset($_SESSION['message2'])) {
        $message2 = $_SESSION['message2'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width: 600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title><?php echo $vehicleInfo['invMake'], " ", $vehicleInfo['invModel']; ?> | PHP Motors</title>

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

            <h1><?php echo $vehicleInfo['invMake'], " ", $vehicleInfo['invModel']; ?></h1>
            <p>Customer reviews can be seen at the bottom of the page</p>

            <?php
                if (isset($message)) {
                    echo $message;
                }
            ?>

            <div id="details-main">
                <?php
                    if (isset($vehicleInfoDisplay)) {
                        echo $vehicleInfoDisplay;
                    }
                ?>

                <?php
                    if (isset($ThumbnailDisplay)) {
                        echo $ThumbnailDisplay;
                    }
                ?>
            </div>

            <hr>
            <h1>Customer Reviews</h1>

            <?php echo $_SESSION['header']; ?>

            <?php
                if (isset($message1)) {
                    echo $message1;
                }
            ?>

            <?php
                if (isset($reviewForm)) {
                    echo $reviewForm;
                } 
            ?>

            <?php
                if (isset($reviewDisplay)) {
                    echo $reviewDisplay;
                } 
            ?>

            <?php
                if (isset($message2)) {
                    echo $message2;
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
    unset($_SESSION['message1']);
    unset($_SESSION['message2']);
?>