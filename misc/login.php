<?php
header('Content-Type: application/json');
include '../dbconn.php';

    $returnarr = array();
    $uname = "";
    $pword = "";

    // verify the input
    if(isset($_GET["username"]) && isset($_GET["password"])){
        $uname = $_GET["username"];
        $pword = $_GET["password"];

        // query from ldap
        $ldapurl = "http://172.30.201.238:8080/api/ldap/" . $uname. "/" . $pword;

        $canlogin = file_get_contents($ldapurl);
        if($canlogin == "TRUE"){
            // check whether this user is admin
            $sql = "SELECT username from admin_users where username = '$uname'";
            $result = $conn->query($sql);
            $isadmin = false;

            if ($result->num_rows > 0) {
                array_push($returnarr, array("isadmin"=>"true"));
            } else {
                array_push($returnarr, array("isadmin"=>"false"));
            }
        } else {
            array_push($returnarr, array("error"=>"bad credential"));
        }
    
        

    } else {
        array_push($returnarr, array("error"=>"bad input"));
    }
    
    
include '../dbclose.php';

    
    echo json_encode($returnarr);

?>