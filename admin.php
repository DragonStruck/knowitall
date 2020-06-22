<?php
    session_start();

    if (isset($_SESSION["isIngelogd"]) && $_SESSION["isIngelogd"] == session_id()) {

        include "db_connection.php";
        $conn = connect();
        $username = $_SESSION["username"];
        $query = "SELECT `admin` FROM `gebruiker` WHERE naam = '$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $admin = $row["admin"];
        }
        }

        switch ($admin) {
            case "0":
                header("location: profiel.php");
                break;
            case "1":

                break;
        }

    } else {
        header("location: profiel.php");
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
    <link rel="stylesheet" href="./css/profiel.css">



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
    <div class="admincontainer">
        <div class="welkomadmin">Admin pagina</div>
        <div class="adminkeurweetje">
            <?php
            keurWeetje();
            ?>
        </div>
        <div class="adminusers"></div>
    </div>
    <div class="admincontainerdp">
        <div class="welkomadmin">Admin pagina</div>
        <div class="admincontainerdp2">
            <div class="adminkeurweetje">
               <?php
               keurWeetjeDP();
               ?>
            </div>
            <div class="adminusers" style="margin-left: 200px">
                <p>Gebruikers:</p>
                <?php
                GebruikerView();
                ?>
            </div>
        </div>.

    </div>

</main>
<script src="./js/main.js"></script>
</body>

</html>