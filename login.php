<?php
include("db_connection.php");
$melding = null;

if (isset($_POST["action"])) {
    $action = $_POST["action"];
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);


    switch ($action) {
        case "login":
            if (CheckUser($username, $password)) {
                session_start();
                if (!$_SESSION) {
                    $_SESSION["username"] = $username;
                    $_SESSION["isIngelogd"] = session_id();
                    header("location: profiel.php");
                }
                header("location: profiel.php");
            } else {
                $melding = "<p>Inloggen mislukt</p>";
            }

            break;
        case "registreren":
            $email = htmlspecialchars($_POST["email"]);
            $password2 = htmlspecialchars($_POST["password2"]);

            if ($password == $password2) {
                if (InsertUser($username, $email, $password)) {
                    $melding = "<p>Account is aangemaakt</p>";
                } else {
                    $melding = "<p>Account aanmaken is mislukt</p>";
                }
            } else {
                $melding = "<p>password is niet het zelfde</p>";
            }
            break;
    }
}



$sbmtmsg = "Login";
$postact = "login";
$nga = <<< DATA

        <p class="nieuwacc">Nog geen account? <a href="login.php?action=registreren">Maak er een aan</a>!</p>

DATA;
$scndpass = null;
$email = null;


if (isset($_GET["action"])) {
    $action = $_GET["action"];

    switch ($action) {
        case "registreren":
            $sbmtmsg = "Registreer";
            $postact = "registreren";
            $nga = <<< DATA
                <p class="nieuwacc">Al een account? <a href="login.php">Log in</a>!</p>
DATA;
            $scndpass = <<< DATA
                <input class="password" type="password" name="password2" placeholder="Retype Password">
DATA;
            $email = <<< DATA
                <input class="email" type="email" name="email" placeholder="E-mail">
DATA;

            break;
    }
}
?>
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

<main class="main">

    <form class="loginform" action="login.php" method="post">
        <p class="title"><?=$sbmtmsg?></p>
        <input class="username" type="text" name="username" placeholder="Username">
        <?=$email?>
        <input class="password" type="password" name="password" placeholder="Password">
        <?=$scndpass?>
        <input type="hidden" name="action" value="<?=$postact?>">
        <input class="loginsubmit" type="submit" value="<?=$sbmtmsg?>">
        <?=$nga?>
        <?=$melding?>
    </form>
</main>
<script src="./js/main.js"></script>
</body>

</html>