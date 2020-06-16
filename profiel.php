<?php
session_start();
if (isset($_SESSION["isIngelogd"]) && $_SESSION["isIngelogd"] == session_id()) {

} else {
    header("location: login.php");
}
if(isset($_POST['verzenden'])) {

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "knowitall";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);


    $datum = htmlspecialchars($_POST["datum"]);
    $weetje = htmlspecialchars($_POST["weetje"]);
    $weetjeextra = htmlspecialchars($_POST["weetjeextra"]);

//    Afbeelding
    $image = $_FILES['image']['name'];
    $target = "weetjeimg/".basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));

//    Kijken of het een afbeelding is
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Als bestand te groot is
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Formaat
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded."; } else {
        $sql = "INSERT INTO weetje (datum, titel, weetje, extra, afbeelding, status, gebruiker) VALUES ('$datum','placeholder','$weetje','$weetjeextra','$image','goedgekeurd','Milan')";

        $conn->query($sql);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "image uploaded succesfully";
        } else {
            echo "failed";
        }
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
        <img class="logoimg" src="img/boekje.png">
        <span class="logotekst">KnowItAll</span>
        <div class="topbarmenu">
            <a href="index.php">Home</a>
            <a href="willekeurig.php">Willekeurig Weetje</a>
            <a href="profiel.php">Profiel</a>
        </div>
    </header>


    <main class="main">
        <div class="profiellinks">
            <div class="userinfo middle">
                <div class="userinfomobile">
                    <p>Name</p>
                    <p>Weetjes:</p>
                </div>
                <div class="userinfodesktop">
                    <p>Naam:</p>
                    <p>E-mail:</p>
                    <p>Goedgekeurde weetjes:</p>
                </div>

            </div>
            <div class="sendweetjes">
                <div class="sendweetjestitle middle"><p>Ingestuurde weetjes</p></div>
                <div class="sendweetjesmain middle">
                    ......
                </div>
            </div>
        </div>
        <div class="profielrechts">
            <div class="weetjeinsturen">
                <form action="profiel.php" method="post" enctype="multipart/form-data">
                    <p style="text-align: center; font-size: 1.2em">Weetje insturen</p>
                    <label>Datum: </label><input class="submitform" name="datum" type="date">
                    <textarea class="textareamedium" name="weetje" placeholder="Vul hier je weetje in"></textarea>
                    <textarea class="textarealarge" name="weetjeextra" placeholder="Vul hier extra informatie in"></textarea>

                    <label class="afbeeldingubtton">
                        <label >Kies afbeelding: </label>
                        <input type="file" name="image" style="display: none;">
                        <a style="font-size: .8em; border: 1px solid black; padding: 2px">Bladeren</a>
                    </label>

                    <input type="submit" class="voorbeeldbutton" name="voorbeeld" value="Voorbeeld">
                    <input type="submit" class="submitbutton" name="verzenden">
                </form>
            </div>
        </div>

    </main>
    <script src="./js/main.js"></script>
</body>

</html>