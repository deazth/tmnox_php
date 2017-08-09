<?php
    header('Content-Type: application/json');
    $returnarr = array();
    $orderno = "";

    // verify the input
    if(isset($_GET["orderno"]) && isset($_GET["activityid"])){
        $orderno = $_GET["orderno"];
        $activityid = $_GET["activityid"];

        $theurl = "http://172.30.201.238:8080/api/getActivitySWIFT?filter[]=order_number,eq," 
            . $orderno . "&filter[]=activity_id,eq," . $activityid;

        $json = file_get_contents($theurl);
        $obj = json_decode($json);

        $arrecords = $obj->getActivitySWIFT->records;

        if(count($arrecords) > 0){
            $returnarr = array("sw_status"=>$arrecords[0][3]);
        } else {
            $returnarr = array("error"=>"bad input");
        }
        


    } else {
        $returnarr = array("error"=>"bad input");
    }

    echo json_encode($returnarr);

?>