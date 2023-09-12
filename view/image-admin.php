<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
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
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width: 600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title>Image Management | PHP Motors</title>

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
            <h1>Image Management</h1>
            <p>Welcome to the Image Management page! Here you can choose to add a new vehicle or delete an already existing vehicle.</p>
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
                <label>Upload Image:</label>
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>

            <hr>

            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>

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