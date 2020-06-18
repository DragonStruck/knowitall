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
<i class="fa fa-calendar " id="calender" aria-hidden="true"></i>
<div id="menu-button" class="menu-button">
    <i id="open-menu" class="hamburger fas fa-bars visible"></i>
    <i id="close-menu" class="hamburger fas fa-times"></i>
</div>
<div class="menubody" id="menubody">
    <div class="menuLinkContainer" id="menuLinkContainer">
        <a class="menuLinks" href="index.php" id="top">Home</a>
        <a class="menuLinks menuactive" href="willekeurig.php">Willekeurig weetje</a>
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

<div class="dateselector addtop" id="calenderbody" >
    <form class="agenda">
        <input name="agenda" action="db_connection.php" type="date" onchange="this.form.submit()">
    </form>
</div>
<main class="main">

    <p class="title">Willekeurig weetje</p>
    <div class="willekeuriguitleg" id="willekeuriguitleg">
        <p>Gebruik de kalender bovenaan de pagina om een datum te kiezen...</p>
        <p>Als er geen weetje voor die datum is wordt er een willekeurig weetje gekozen</p>
    </div>

    <?php
    include "db_connection.php";
//    openRandomCon();
    ?>
</main>
<script src="./js/main.js"></script>
</body>

</html>