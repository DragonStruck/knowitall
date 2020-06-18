


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
?>
<script>
    function changeBackground(variable) {
        let img = variable;
        console.log(img);

        const weetjePicca = document.querySelector('.weetje');
        weetjePicca.style.backgroundImage = `url(./weetjeimg/${img})`;
    }

</script>
