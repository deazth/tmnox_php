<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../dbconn.php';

    $returnarr = array();
    $osm_id = "";

    // verify the input
    if(isset($_GET["osm_id"])){
        $osm_id = $_GET["osm_id"];

        // get the payload
        $sql = "SELECT rec_id, eai_id, audit_date_time, event_name, audit_type from eai_info where osm_id = '$osm_id' order by rec_id";
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