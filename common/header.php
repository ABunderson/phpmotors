<div id="top_header">
    <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="Logo for PHP Motors" id="logo"></a>

        <?php
        // if (isset($cookieFirstname)){
        //     echo "<p>Welcome $cookieFirstname</p>";
        // }
        if (isset($_SESSION['loggedin'])) {
            echo "<div><a href='/phpmotors/accounts/index.php' title='View account information'>Hello, ", $_SESSION['clientData']['clientFirstname'], "  </a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='/phpmotors/accounts/index.php?action=logout' title='Logout of current account'>  Logout</a></div>";
        } else {
            echo "<div><a href='/phpmotors/accounts/index.php?action=login' id='my_account_a' title='Login or Register with PHP Motors'>My Account</a></div>";
        }

        ?>
        

</div>