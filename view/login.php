<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">

    <title>Login Page | PHP Motors</title>

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
            <h1>Sign In</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form method="post" action="/phpmotors/accounts/">
                <label for="clientEmail">Email</label>
                <input name="clientEmail" id="clientEmail" type="email" <?php if (isset($clientEmail)) {
                                                                            echo "value='$clientEmail'";
                                                                        } ?> required>

                <label for="clientPassword">Password</label>
                <span class="form">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character<br></span>
                <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                <input type="submit" name="submit" id="loginBtn" value="Login">
                <input type="hidden" name="action" value="Login">
            </form>

            <a href='/phpmotors/accounts/index.php?action=registration' title='Become a member' id="loginRegister">Not a member yet?</a>
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