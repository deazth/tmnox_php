<?php
header('Content-Type: application/json');

include '../dbconn.php';

    $returnarr = array();
    $osm_id = "";
    $sdnum = "";

    // verify the input
    if(isset($_GET["sdnum"])){
        $sdnum = $_GET["sdnum"];
        $closecode = $_GET["closecode"];
        $solution = $_GET["solution"];
        $reasoncode = $_GET["reasoncode"];
        $remark = $_GET["remark"];

        // get the latest running number
        $sql = "select * from dummy_iris where interaction_id = '$sdnum'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $returnarr = $result->fetch_assoc();
        } else {
            $returnarr = array("error"=>"SD not found");
        }

    } else {
        $returnarr = array("error"=>"bad input");
    }
    
    
include '../dbclose.php';

    
    echo json_encode($returnarr);

?>