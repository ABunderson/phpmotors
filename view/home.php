<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="(min-width:600px)">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="(min-width: 992px)">
    
    <title>Home Page | PHP Motors</title>

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
            <h1>Welcome to PHP Motors!</h1>
            <section id="delorean_section">

                <div id="delorean_text">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                </div>

                <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean car" id="delorean_image">

                <button type="button" id="delorean_button">Own Today</button>

            </section> <!-- Delorean section ends -->

            <div id="delorean_info">
            <section id="delorean_reviews">
                <h2>DMC Delorean Reviews</h2>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </section> <!-- review section ends -->

            <section id="delorean_upgrades">
                <h2>Delorean Upgrades</h2>
                <div id="delorean_upgrades_grid">
                <article id="flux_capacitor_information">
                    <span class="image_box">
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor" id="flux_capacitor">
                    </span>
                    <h3><a href="#" title="Flux capacitor page">Flux Capacitor</a></h3>
                </article>
                <article id="flame_decals_information">
                    <span class="image_box">
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame decal" id="flame_decal">
                    </span>
                    <h3><a href="#" title="Flame decals page">Flame Decals</a></h3>
                </article>
                <article id="bumper_stickers_information">
                    <span class="image_box">
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="generic bumper sticker" id="bumper_sticker">
                    </span>
                    <h3><a href="#" title="bumper stickers page">Bumper Stickers</a></h3>
                </article>
                <article id="hub_caps_information">
                    <span class="image_box">
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub cap" id="hub_cap">
                    </span>
                    <h3><a href="#" title="Hub caps page">Hub Caps</a></h3>
                </article>
                </div>
            </section> <!-- upgrades section ends -->
            </div>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php' ?>
        </footer>
    </div> <!-- wrapper ends -->

</body>

</html>