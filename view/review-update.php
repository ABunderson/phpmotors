<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
if (!isset($_SESSION['loggedin'])) {
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

    <title>Update Review | PHP Motors</title>

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
            <h1>Update Review</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h2><?php echo $reviewInfo['invMake'], " ", $reviewInfo['invModel']; ?> Review</h2>
            <p>Reviewed on <?php echo  $date; ?></p>
            <form action='/phpmotors/reviews/' method='post'>
                <fieldset>
                    <label for='reviewText'>Review:</label>
                    <textarea name='reviewText' id='reviewText' required rows='10'><?php if (isset($reviewText)) {
                                                                                        echo "$reviewText";
                                                                                    } elseif (isset($reviewInfo['reviewText'])) {
                                                                                        echo "$reviewInfo[reviewText]";
                                                                                    } ?></textarea>

                    <input type='submit' class='regbtn' value='Update Review'>
                    <input type='hidden' name='action' value='updateReview'>
                    <input type='hidden' name='reviewId' id='reviewId' value=' 
                    <?php echo $reviewInfo['reviewId'];
                    ?>'>
                    <!-- <input type='hidden' name='invId' id='invId' value='$vehicleInfo[invId]'> -->

                </fieldset>
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