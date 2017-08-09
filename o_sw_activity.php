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
            print_r($arrecords);
        } else {
            print_r(array("error"=>"No record"));
        }
        


    } else {
        $returnarr = array("error"=>"bad input");
    }

    // echo json_encode($returnarr);

?>