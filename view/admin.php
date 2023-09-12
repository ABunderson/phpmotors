<?php
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
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title>Admin Page | PHP Motors</title>

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
            <h1>
                <?php
                $name = $_SESSION['clientData']['clientFirstname'];
                $name .= ' ';
                $name .= $_SESSION['clientData']['clientLastname'];
                echo "$name, You are logged in";
                ?>
            </h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <h2>Account Information</h2>
            <ul>
                <?php
                echo "<li>First Name: ", $_SESSION['clientData']['clientFirstname'], "</li>";
                echo "<li>Last Name: ", $_SESSION['clientData']['clientLastname'], "</li>";
                echo "<li>Email: ", $_SESSION['clientData']['clientEmail'], "</li>";
                ?>
            </ul>
            <a href='/phpmotors/accounts/index.php?action=update' title='Update account information'>Update account information</a>
            <br>
            <?php
            if (isset($adminTools)) {
                echo $adminTools;
            }
            ?>
            <h2>Manage all Product Reviews</h2>
            <?php
            if (isset($adminReviewList)) {
                echo $adminReviewList;
            }
            if (isset($_SESSION['message1'])) {
                echo $_SESSION['message1'];
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
?>