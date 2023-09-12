<?php
//Check if logged in and has a clientLevel greater than 1 if not return to home page
if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2) {
    header("Location: ../index.php");
    exit;
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

    <title><?php
            if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            }
            ?> | PHP Motors</title>

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
            <h1><?php
                if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                }
                ?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/vehicles/index.php">

                <label for="invMake">Make</label>
                <input name="invMake" id="invMake" type="text" readonly <?php if (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                } ?>>

                <label for="invModel">Model</label>
                <input name="invModel" id="invModel" type="text" readonly <?php if (isset($invInfo['invModel'])) {
                                                                        echo "value='$invInfo[invModel]'";
                                                                    } ?>>

                <label for="invDescription">Description</label>
                <textarea name="invDescription" id="invDescription" readonly><?php if (isset($invInfo['invDescription'])) {
                                                                                    echo "$invInfo[invDescription]";
                                                                                } ?></textarea>

               
                <input type="submit" name="submit" value="Delete Vehicle">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php
                                                            if (isset($invId)) {
                                                                echo $invId;
                                                            }
                                                            ?>">

            </form>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php' ?>
        </footer>
    </div> <!-- wrapper ends -->

</body>

</html><?php
unset($_SESSION['message']);
?>