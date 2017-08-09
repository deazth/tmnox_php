 <?php
$servername = "172.30.141.211";
$username = "team21";
$password = "team21";
$dbname = "team21";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
$conn->close();
?> 