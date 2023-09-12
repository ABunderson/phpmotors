<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}
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
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title>Client Update | PHP Motors</title>

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
            <h1>Update Client Information</h1>
            <h2>Account Update</h2>
            <p>Change first name, last name, and/or email address.</p>
            <?php if (isset($message1)) {
                echo $message1;
            } ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <label for="clientFirstname">First Name</label>
                <input name="clientFirstname" id="clientFirstname" type="text" <?php if (isset($clientFirstname) && $clientFirstname !== "") {
                                                                                    echo "value='$clientFirstname'";
                                                                                } else {
                                                                                    $firstName = $_SESSION['clientData']['clientFirstname'];
                                                                                    echo "value='$firstName'";
                                                                                }
                                                                                ?> required>

                <label for="clientLastname">Last Name</label>
                <input name="clientLastname" id="clientLastname" type="text" <?php if (isset($clientLastname) && $clientLastname !== "") {
                                                                                    echo "value='$clientLastname'";
                                                                                } else {
                                                                                    $lastName = $_SESSION['clientData']['clientLastname'];
                                                                                    echo "value='$lastName'";
                                                                                }
                                                                                ?> required>

                <label for="clientEmail">Email</label>
                <input name="clientEmail" id="clientEmail" type="email" <?php if (isset($clientEmail) && $clientEmail !== '') {
                                                                            echo "value='$clientEmail'";
                                                                        } else {
                                                                            $email = $_SESSION['clientData']['clientEmail'];
                                                                            echo "value='$email'";
                                                                        }
                                                                        ?> required>


                <input type="submit" name="submit" value="Update">
                <input type="hidden" name="action" value="modAccount">
                <input type="hidden" name="clientId" value="<?php
                                                            if (isset($_SESSION['clientData']['clientId'])) {
                                                                echo $_SESSION['clientData']['clientId'];
                                                            } elseif (isset($clientId)) {
                                                                echo $clientId;
                                                            }
                                                            ?>">
            </form>
            <h2>Change Password</h2>
            <p>Please enter a new password. This will overwrite the previous password.</p>
            <?php if (isset($message2)) {
                echo $message2;
            } ?>
            <form method="post" action="/phpmotors/accounts/">
                <label for="clientPassword">Password</label>
                <span class="form">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character<br></span>
                <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                <input type="submit" name="submit" value="Change Password">
                <input type="hidden" name="action" value="modPassword">
                <input type="hidden" name="clientId" value="<?php
                                                            if (isset($_SESSION['clientData']['clientId'])) {
                                                                echo $_SESSION['clientData']['clientId'];
                                                            } elseif (isset($clientId)) {
                                                                echo $clientId;
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

</html>
<?php
unset($_SESSION['message']);
unset($_SESSION['message1']);
unset($_SESSION['message2']);
?>