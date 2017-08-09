<?php
    header('Content-Type: application/json');
    $returnarr = array();
    $searchParam = "";

    // verify the input
    if(isset($_GET["orderno"])){
        $searchParam = $_GET["orderno"];

        $theurl = "http://172.30.201.238:8080/api/getOSMInfo?filter=order_number,eq," . $searchParam;


        $json = file_get_contents($theurl);
        $obj = json_decode($json);

        $arrecords = $obj->getOSMInfo->records;
        $osm_id = "";
        $task_mne = "";
        $osm_state = "";
        $osm_process = "";
        $corr_id = "";

        if(count($arrecords) > 0){
            $osm_id = $arrecords[0][1];
            $task_mne = $arrecords[0][2];
            $osm_state = $arrecords[0][3];
            $osm_process = $arrecords[0][4];
            $corr_id = $arrecords[0][5];
 

            $returnarr = array(
                "osm_id"=>$osm_id,
                "task_mne"=>$task_mne,
                "osm_state"=>$osm_state,
                "osm_process"=>$osm_process,
                "corr_id"=>$corr_id
            );

        } else {
            $returnarr = array("error"=>"record not found");
        }

    } else {
        $returnarr = array("error"=>"bad input");
    }

    echo json_encode($returnarr);

?>