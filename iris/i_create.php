<?php
header('Content-Type: application/json');

include '../dbconn.php';

    $returnarr = array();
    $osm_id = "";
    $sd_num = "";

    // verify the input
    if(isset($_GET["contact"])){
        $contact = $_GET["contact"];
        $notifyby = $_GET["notifyby"];
        $urg = $_GET["urg"];
        $impact = $_GET["impact"];
        $svcseg = $_GET["svcseg"];
        $category = $_GET["category"];
        $area = $_GET["area"];
        $subarea = $_GET["subarea"];
        $probtype = $_GET["probtype"];
        $ref = $_GET["ref"];
        $title = $_GET["title"];
        $desc = $_GET["desc"];

        // get the latest running number
        $sql = "select currnum from running_number where rn_type = 'SD'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sd_num = 'SD' . $row->currnum;
                // update the number
                $sql = "update running_number set currnum = currnum + 1 where rn_type = 'SD'";
                $conn->query($sql);
            }
        } else {
            $sd_num = 'SD1000222';
        } 

        // insert into DB
        $sql = "insert into dummy_iris (interaction_id, status, contact, notify_by, urgency, service_segment, category, " .
        " area, sub_area, problem_type, reference, title, description) values (" .
        ."'$sd_num', 'New', '$contact', '$notifyby', '$urg', '$svcseg', '$category', '$area', '$subarea', '$probtype', '$ref', '$title', '$desc')";
        $conn->query($sql);

        $returnarr = array("sdnum"=>$sd_num);

    } else {
        $returnarr = array("error"=>"bad input");
    }
    
    
include '../dbclose.php';

    
    echo json_encode($returnarr);

?>