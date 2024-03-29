
<?php
session_start();
if (isset($_SESSION["isIngelogd"]) && $_SESSION["isIngelogd"] == session_id()) {

} else {
    header("location: login.php");
}



$username = $_SESSION["username"];

include "db_connection.php";
$conn = connect();
if(isset($_POST['verzenden'])) {

    $datum = $_POST["datum"];
    $weetje = htmlspecialchars($_POST["weetje"]);
    $weetjeextra = htmlspecialchars($_POST["weetjeextra"]);

//    Afbeelding

    $image = $_FILES['image']['name'];
    $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $filename = rand(0, 10000).".".$imageFileType;
    $target = "weetjeimg/".$filename;
    $uploadOk = 1;


    // Formaat
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Verboden file type')</script>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        } else {
        $sql = "INSERT INTO weetje (datum, titel, weetje, extra, afbeelding, status, gebruiker) VALUES ('$datum','placeholder','$weetje','$weetjeextra','$filename','ongekeurd','$username')";

        $conn->query($sql);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "<script>alert('Weetje ingestuurd')</script>";
        } else {
            echo "<script>alert('Weetje is niet ingestuurd')</script>";
        }
    }


}


//Ingestuurde weetjes
function ingestuurdeWeetjes()
{
    $conn = connect();
    $username = $_SESSION["username"];
    $sql3 = "SELECT * FROM `weetje` WHERE gebruiker = '$username' ORDER BY ID DESC";
    $result3 = $conn->query($sql3);
    while ($row = $result3->fetch_assoc()) {
        echo '<div class="weetjecontainer">
                            <div class="informationbody">
                                <p class="sendweetjesdatum">' . $row["datum"] . '</p>
                                <p class="sendweetjesweetje">'.$row["weetje"].'</p>
                                <p class="sendweetjesstatus">'.$row["status"].'</p>
                                <span class="sendweetjesbutton ">Voorbeeld</span>
                            </div>
                        </div>';
    }
}

function checkAdmin()
{
    $conn = connect();
    $username = $_SESSION["username"];
    $sql3 = "SELECT admin FROM `gebruiker` WHERE naam = '$username'";
    $result3 = $conn->query($sql3);
    while ($row = $result3->fetch_assoc()) {

        if ($row["admin"] == 1) {
            echo "<a href=\"admin.php\" id=\"admin2\">Admin</a>";
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
<i class="fa fa-upload " id="upload" aria-hidden="true"></i>

    <div id="menu-button" class="menu-button">
        <i id="open-menu" class="hamburger fas fa-bars visible"></i>
        <i id="close-menu" class="hamburger fas fa-times"></i>
    </div>
    <div class="menubody" id="menubody">
        <div class="menuLinkContainer" id="menuLinkContainer">
            <a class="menuLinks menuactive" href="index.php" id="top">Home</a>
            <a class="menuLinks" href="willekeurig.php">Willekeurig weetje</a>
            <a class="menuLinks" href="profiel.php">Profiel</a>
            <a class="menuLinks" id="admin1" href="admin.php">Admin</a>
        </div>
    </div>

    <header class="header">
        <a href="index.php"><img class="logoimg" src="img/boekje.png"></a>
        <span class="logotekst">KnowItAll</span>
        <div class="topbarmenu">
            <a href="index.php">Home</a>
            <a href="willekeurig.php">Willekeurig Weetje</a>
            <a href="profiel.php">Profiel</a>
            <?php
            checkAdmin();
            ?>

        </div>
    </header>
    <main class="main">
        <div class="profiellinks">
            <div class="userinfo middle">
                <div class="userinfomobile">
                    <p><?php echo "Welkom ". $username . "!" ?></p>
                    <p>Weetjes: <?php $sql3 = "SELECT COUNT(weetje) AS 'aantal' FROM weetje WHERE gebruiker = '$username' AND status = 'goedgekeurd'";
                        $result3 = $conn->query($sql3);
                        while($row = $result3->fetch_assoc()) {
                            echo $row["aantal"];
                        }?></p>
                </div>
                <div class="userinfodesktop">
                    <p>Naam: <?php echo $username ?></p>
                    <p>E-mail: <?php $sql3 = "SELECT `naam`,`e-mail` from gebruiker WHERE naam = '$username'";
                        $result3 = $conn->query($sql3);
                        while($row = $result3->fetch_assoc()) {
                            echo $row["e-mail"];
                        }?></p>
                    <p>Goedgekeurde weetjes: <?php $sql3 = "SELECT COUNT(weetje) AS 'aantal' FROM weetje WHERE gebruiker = '$username' AND status = 'goedgekeurd'";
                        $result3 = $conn->query($sql3);
                        while($row = $result3->fetch_assoc()) {
                            echo $row["aantal"];
                        }?> </p>
                </div>

            </div>
            <div class="sendweetjes">
                <div class="sendweetjestitle"><p>Ingestuurde weetjes</p></div>
                <div class="sendweetjesmain">
                    <div class="sendweetjesmaindp">
                        <?php
                        ingestuurdeWeetjes();
                        ?>
                        </div>
                    </div>
                    <div class="sendweetjesmainmob">

                    </div>
                </div>
            </div>
        </div>
        <div class="profielrechts" id="formbody">
            <script>function validateForm() {
                    var datum = document.forms["insturenform"]["datum"].value;
                    var weetje = document.forms["insturenform"]["weetje"].value;
                    if (datum == "") {
                        alert("Datum moet ingevuld zijn");
                        return false;
                    } else if (weetje == "") {
                        alert("Weetje moet ingevuld zijn");
                        return false;
                    }
                }</script>
            <div class="weetjeinsturen" id="formbody2">
                <form name="insturenform" action="profiel.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                    <p style="text-align: center; font-size: 1.2em">Weetje insturen</p>
                    <label>Datum: </label><input class="submitform" name="datum" type="date">
                    <textarea class="textareamedium" name="weetje" placeholder="Vul hier je weetje in"></textarea>
                    <textarea class="textarealarge" name="weetjeextra" placeholder="Vul hier extra informatie in"></textarea>

                    <label class="afbeeldingubtton">
                        <label >Kies afbeelding: </label>
                        <input type="file" name="image" style="display: none;">
                        <a style="font-size: .8em; border: 1px solid black; padding: 2px">Bladeren</a>
                    </label>

                    <input type="submit" class="submitbutton" name="verzenden" value="Verzenden">
                </form>
            </div>
        </div>

    </main>
<script src="./js/main.js"></script>

</body>
<script>
    const formButton = document.querySelector('#upload');
    const formBody = document.querySelector('#formbody');
    const formBody2 = document.querySelector('#formbody2');

    let formStatus = false;

    formButton.addEventListener('click', () => {
        console.log("sdfw");
        if (formStatus == false) {
            // formBody.style.display = "block"
            // formBody.style.position = "absolute"
            formBody2.style.width = "100vw"
            formBody.classList.add('mobileform')


            formStatus = true;
        } else if (formStatus == true) {
            formBody.classList.remove('mobileform')
            formStatus = false;
        }
    });

</script>
</html>