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
        $sql = "update dummy_iris set status = 'Closed', closure_code = '$closecode', solution = '$solution', reason_code = '$reasoncode', remarks = '$remark' where interaction_id = '$sdnum'";
        $result = $conn->query($sql);

        $returnarr = array("status"=>"success");

    } else {
        $returnarr = array("error"=>"bad input");
    }
    
    
include '../dbclose.php';

    
    echo json_encode($returnarr);

?>