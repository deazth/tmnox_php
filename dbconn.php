 <?php
    $servername = "172.30.141.211";
    $username = "team21";
    $password = "team21";
    $dbname = "team21";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection is failed: " . $conn->connect_error);
    }

?> 