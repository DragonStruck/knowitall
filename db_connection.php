
<script>
    function changeBackground(variable) {
        let img = variable;
        console.log(img);

        const weetjePicca = document.querySelector('.weetje');
        weetjePicca.style.backgroundImage = `url(./weetjeimg/${img})`;
    }


</script>
<?php

function connect() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "knowitall";
//
//    $dbhost = "localhost";
//    $dbuser = "student4a9_544194";
//    $dbpass = "DjWzUE";
//    $db = "student4a9_544194";

    static $conn = null;

    if (!isset($conn)) {
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
    }

    if ($conn->connect_error) {
        die("Connection failed: $conn->connect_error");
    }

    return $conn;
}


function OpenCon(){
    $conn = connect();

    $query = "SELECT * FROM weetje WHERE MONTH(datum) = MONTH(CURRENT_DATE) AND DAY(datum) = day(CURRENT_DATE) AND status = 'goedgekeurd' ORDER BY RAND() LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
                echo '<div class="weetje">
            <h2 class="weetjedatum">'.$row["datum"] .'</h2>
            <h3 class="weetjeintro">'.$row["weetje"].'</h3>
        </div>
        <div class="weetjeextra">
            <h1 class="weetjetitle">Extra informatie</h1>
            <p class="weetjetekst">'.$row["extra"].'</p>
        </div>';
                echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";
        }
    } else {


        $query = "SELECT * FROM weetje WHERE status = 'goedgekeurd' ORDER BY RAND() LIMIT 1;";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="weetje">
            <h2 class="weetjedatum">'.$row["datum"] .'</h2>
            <h3 class="weetjeintro">'.$row["weetje"].'</h3>
        </div>
        <div class="weetjeextra">
            <h1 class="weetjetitle">Extra informatie</h1>
            <p class="weetjetekst">'.$row["extra"].'</p>
        </div>';
                echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";
            }
        } else {
            echo "Geen resultaten";
        }
    }
    $conn->close();
}

function CloseCon($conn) {
    $conn -> close();
}


function OpenRandomCon(){
    $conn = connect();

    $query = "SELECT * FROM weetje WHERE status = 'goedgekeurd' ORDER BY RAND() LIMIT 1;";
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="weetje">
            <h2 class="weetjedatum">'.$row["datum"] .'</h2>
            <h3 class="weetjeintro">'.$row["weetje"].'</h3>
        </div>
        <div class="weetjeextra">
            <h1 class="weetjetitle">Extra informatie</h1>
            <p class="weetjetekst">'.$row["extra"].'</p>
        </div>';
            echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";
        }
    } else {
        echo "Geen resultaten";
    }
    $conn->close();
}

function OpenDateCon($kalenderdatum){
    $conn = connect();

    $query = "SELECT * FROM weetje WHERE datum = '".$kalenderdatum."' AND status = 'goedgekeurd' ORDER BY RAND() LIMIT 1";
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<script>document.getElementById("willekeuriguitleg").style.display = "none" </script>';
            echo '<div class="weetje">
            <h2 class="weetjedatum">'.$row["datum"] .'</h2>
            <h3 class="weetjeintro">'.$row["weetje"].'</h3>
        </div>
        <div class="weetjeextra">
            <h1 class="weetjetitle">Extra informatie</h1>
            <p class="weetjetekst">'.$row["extra"].'</p>
        </div>';
            echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";
        }
    } else {
        $query = "SELECT * FROM weetje WHERE status = 'goedgekeurd' ORDER BY RAND() LIMIT 1;";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<script>document.getElementById("willekeuriguitleg").style.display = "none" </script>';
                echo '<div class="weetje">
            <h2 class="weetjedatum">'.$row["datum"] .'</h2>
            <h3 class="weetjeintro">'.$row["weetje"].'</h3>
        </div>
        <div class="weetjeextra">
            <h1 class="weetjetitle">Extra informatie</h1>
            <p class="weetjetekst">'.$row["extra"].'</p>
        </div>';
                echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";

            }
        } else {
            echo "Geen resultaten";
        }
    }
    $conn->close();
}
if (isset($_GET["agenda"])) {
    $agendadatum= $_GET["agenda"];
    openDateCon($agendadatum);
}



function InsertUser($username, $email, $password) {

    $result = false;

    $query = "INSERT INTO `gebruiker` (`ID`, `naam`, `e-mail`, `wachtwoord`, `datum`, `admin`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP, '0');";
    $conn = connect();
    $stmt = $conn->prepare($query);

    $hpw = password_hash($password,PASSWORD_DEFAULT);

    $stmt->bind_param("sss", $username, $email, $hpw);

    if ($stmt->execute()) {
        $result = true;
    }
    return $result;
}

function CheckUser($username, $password) {
    $result = false;
    $hashedPassword = null;

    $query = "SELECT `wachtwoord` FROM `gebruiker` WHERE `naam` = ?;";
    $conn = connect();
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $stmt->bind_result($hashedPassword);
        if ($stmt->fetch()) {
            if (password_verify($password,$hashedPassword)) {
                $result = true;
            }
        }
    }
    return $result;
}

function keurWeetje()
{


    $conn = connect();

    $query = "SELECT * FROM weetje WHERE status = 'ongekeurd' LIMIT 1";
    $result = $conn->query($query);

//    if($result2 = $conn->query("SELECT gebruiker.`e-mail` from gebruiker INNER JOIN weetje ON gebruiker.naam = weetje.gebruiker WHERE weetje.ID = $id")) {
//        if ($result2->num_rows > 0) {
//            while ($row = $result2->fetch_assoc()) {
//                mail($row["e-mail"],"KnowItAll: Weetje", "Je weetje is goedgekeurd");
//            }
//        }
//    }
    //delete row on button click
    if(isset($_GET["del"])){
        $id = $_GET["del"];
        if($conn->query("DELETE FROM weetje WHERE ID=$id")){
            header('Location: admin.php');
        } else {
            echo "Failed to delete.";
        }
    }
    if(isset($_GET["upd"])){
        $id = $_GET["upd"];
        if($conn->query("    
    UPDATE weetje
    SET status = 'goedgekeurd'
    WHERE ID=$id")){
            header('Location: admin.php');

        } else {
            echo "Failed to delete.";
        }
    }

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="weetje" style="width: 85vw">
            <h2 class="weetjedatum">'.$row["datum"] .'</h2>
            <h3 class="weetjeintro">'.$row["weetje"].'</h3>
        </div>
        <div class="weetjeextra" style="width: 85vw" >
            <p class="weetjetekst">'.$row["extra"].'</p>
        </div>
        <div class="buttoncontainer">
            <div class="keurbutton"><a href="admin.php?upd='.$row["ID"].'">Weetje goedkeuren</a></div>
            <div class="keurbutton"><a href="admin.php?del='.$row["ID"].'">Weetje afkeuren</a></div>
        </div>
        ';
            echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";
        }
    } else {
        echo "Geen resultaten";
    }


}
function keurWeetjeDP()
{


    $conn = connect();

    $query = "SELECT * FROM weetje WHERE status = 'ongekeurd' LIMIT 4";
    $result = $conn->query($query);

//    if($result2 = $conn->query("SELECT gebruiker.`e-mail` from gebruiker INNER JOIN weetje ON gebruiker.naam = weetje.gebruiker WHERE weetje.ID = $id")) {
//        if ($result2->num_rows > 0) {
//            while ($row = $result2->fetch_assoc()) {
//                mail($row["e-mail"],"KnowItAll: Weetje", "Je weetje is goedgekeurd");
//            }
//        }
//    }
    //delete row on button click
    if(isset($_GET["del"])){
        $id = $_GET["del"];
        if($conn->query("DELETE FROM weetje WHERE ID=$id")){
            header('Location: admin.php');
        } else {
            echo "Failed to delete.";
        }
    }
    if(isset($_GET["upd"])){
        $id = $_GET["upd"];
        if($conn->query("    
    UPDATE weetje
    SET status = 'goedgekeurd'
    WHERE ID=$id")){
            header('Location: admin.php');

        } else {
            echo "Failed to delete.";
        }
    }

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo ' <div class="keurweetjedp">
                    <div class="keurweetjedpinfo">
                        <p class="keurweetjedatum">Datum: '.$row["datum"] .'</p>
                        <p class="keurweetjeweetje">'.$row["weetje"].'</p>
                        <p class="keurweetjegebruiker">Gebruiker: '.$row["gebruiker"].'</p>

                    </div>
                    <div class="keurweetjedpkeur">
                        <div class="keurweetjebuttons">
                          <a href="admin.php?upd='.$row["ID"].'"><i class="fas fa-check-circle"></a></i>
                            <a href="admin.php?del='.$row["ID"].'"><i class="fas fa-times-circle"></a></i>
                        </div>
                       <a class="keurweetjeafbeelding" href="weetjeimg/'.$row["afbeelding"].'" target="_blank"><span>Afbeelding</span></a>
                    </div>
                </div>
        ';
            echo "<script>changeBackground(`".$row['afbeelding']."`);</script>";
        }
    } else {
        echo "Geen resultaten";
    }


}
function GebruikerView()
{


    $conn = connect();

    $query = "SELECT ID,naam FROM gebruiker;";
    $result = $conn->query($query);
//
    if(isset($_GET["del"])){
        $id = $_GET["del"];
        if($conn->query("DELETE FROM gebruiker WHERE ID=$id")){
            header('Location: admin.php');
        } else {
            echo "Failed to delete.";
        }
    }
//    if(isset($_GET["upd"])){
//        $id = $_GET["upd"];
//        if($conn->query("
//    UPDATE weetje
//    SET status = 'goedgekeurd'
//    WHERE ID=$id")){
//            header('Location: admin.php');
//
//        } else {
//            echo "Failed to delete.";
//        }
//    }

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '                
                <div class="adminusername">
                    <span>'.$row["naam"].'</span>
                    <a href="admin.php?del='.$row["ID"].'"><i class="fas fa-ban"></i></a>
                </div>';
        }
    } else {
        echo "Geen resultaten";
    }
    $conn->close();

}
?>