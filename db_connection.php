<?php

function connect() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "knowitall";

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

    $query = "SELECT * FROM weetje WHERE MONTH(datum) = MONTH(CURRENT_DATE) AND DAY(datum) = day(CURRENT_DATE) LIMIT 1";
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
        }
    } else {


        $query = "SELECT * FROM weetje ORDER BY RAND() LIMIT 1;";
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

    $query = "SELECT * FROM weetje ORDER BY RAND() LIMIT 1;";
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
        }
    } else {
        echo "Geen resultaten";
    }
    $conn->close();
}

function OpenDateCon($kalenderdatum){
    $conn = connect();

    $query = "SELECT * FROM weetje WHERE datum = '".$kalenderdatum."'";
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
        }
    } else {
        $query = "SELECT * FROM weetje ORDER BY RAND() LIMIT 1;";
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
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $result = true;
    }
    return $result;
}