
<?php

function OpenCon(){

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "knowitall";

    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die ("Connect failed: %s\n". $conn -> error);

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
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "knowitall";

    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die ("Connect failed: %s\n". $conn -> error);

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

function OpenDateCon(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "knowitall";
    $date = "2003-06-04";

    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die ("Connect failed: %s\n". $conn -> error);

    $query = "SELECT * FROM weetje WHERE datum = '".$date."'";
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



