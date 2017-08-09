<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../dbconn.php';

    $returnarr = array();
    $rec_id = "";

    // verify the input
    if(isset($_GET["rec_id"])){
        $rec_id = $_GET["rec_id"];

        // get the payload
        $sql = "SELECT payload from eai_info where rec_id = '$rec_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $returnarr = $result;
        } 

    } else {
        array_push($returnarr, array("error"=>"bad input"));
    }
    
    
include '../dbclose.php';

    
    echo json_encode($returnarr);

?>