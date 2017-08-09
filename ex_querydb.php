
<?php

    include 'dbconn.php';

    $sql = "SELECT username from admin_users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["username"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    include 'dbclose.php';

?>