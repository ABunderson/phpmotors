<?php
//Check if logged in and has a clientLevel greater than 1 if not return to home page
if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2) {
    header("Location: ../index.php");
    exit;
}

// Build the drop-down select list
$classificationList = '<label for="classificationId">*Note all Fields are Required</label>';
$classificationList .= '<select name="classificationId" id="classificationId" required>';
$classificationList .= '<option disabled hidden value=""';
//echo "$classificationId";
if (isset($classificationId) !== TRUE || $classificationId === "") {
    $classificationList .= ' selected ';
}
$classificationList .= '>Choose Car Classification</option>';

foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]' ";

    if (isset($classificationId)) {
        if ($classification['classificationId'] == $classificationId) {
            $classificationList .= ' selected ';
        }
    }

    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title>Add Vehicle | PHP Motors</title>

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
            <h1>Add Vehicle</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/vehicles/index.php">
                <?php
                echo $classificationList;
                ?>

                <label for="invMake">Make</label>
                <input name="invMake" id="invMake" type="text" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                } ?> required>

                <label for="invModel">Model</label>
                <input name="invModel" id="invModel" type="text" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    } ?> required>

                <label for="invDescription">Description</label>
                <textarea name="invDescription" id="invDescription" required><?php if (isset($invDescription)) {
                                                                                    echo "$invDescription";
                                                                                } ?></textarea>

                <label for="invImage">Image Path</label>
                <input name="invImage" id="invImage" type="text" value="/phpmotors/images/vehicles/no-image.png" <?php if (isset($invImage)) {
                                                                                                                        echo "value='$invImage'";
                                                                                                                    } ?> required>

                <label for="invThumbnail">Thumbnail Path</label>
                <input name="invThumbnail" id="invThumbnail" type="text" value="/phpmotors/images/vehicles/no-image.png" <?php if (isset($invThumbnail)) {
                                                                                                                                echo "value='$invThumbnail'";
                                                                                                                            } ?> required>

                <label for="invPrice">Price</label>
                <input name="invPrice" id="invPrice" type="number" step="any" min="0" <?php if (isset($invPrice)) {
                                                                                            echo "value='$invPrice'";
                                                                                        } ?> required>

                <label for="invStock">Number in Stock</label>
                <input name="invStock" id="invStock" type="number" min="0" <?php if (isset($invStock)) {
                                                                                echo "value='$invStock'";
                                                                            } ?> required>

                <label for="invColor">Color</label>
                <input name="invColor" id="invColor" type="text" <?php if (isset($invColor)) {
                                                                        echo "value='$invColor'";
                                                                    } ?> required>

                <input type="submit" name="submit" id="addVehicleBtn" value="Add Vehicle">
                <input type="hidden" name="action" value="addVehicle">

            </form>
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