
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b39d5eccc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/mainstyle.css">
    <link rel="stylesheet" href="./css/weetjes.css">

    <link rel="icon" href="img/logo.ico">

    <title>Know It All</title>
</head>

<body>
    <div id="menu-button" class="menu-button">
        <i id="open-menu" class="hamburger fas fa-bars visible"></i>
        <i id="close-menu" class="hamburger fas fa-times"></i>
    </div>
    <div class="menubody" id="menubody">
        <div class="menuLinkContainer" id="menuLinkContainer">
            <a class="menuLinks menuactive" href="index.php" id="top">Home</a>
            <a class="menuLinks" href="willekeurig.php">Willekeurig weetje</a>
            <a class="menuLinks" href="profiel.php">Profiel</a>
        </div>
    </div>

    <header class="header">
        <a href="index.php"><img class="logoimg" src="img/boekje.png"></a>
        <span class="logotekst">KnowItAll</span>
        <div class="topbarmenu">
            <a href="index.php">Home</a>
            <a href="willekeurig.php">Willekeurig Weetje</a>
            <a href="profiel.php">Profiel</a>
        </div>
    </header>


    <main class="main">
    <?php
        include_once "db_connection.php";
        openCon();
    ?>
    </main>
    <script src="./js/main.js"></script>
</body>

</html>