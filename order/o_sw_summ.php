<?php
    header('Content-Type: application/json');
    $returnarr = array();
    $searchParam = "";

    // verify the input
    if(isset($_GET["orderno"])){
        $searchParam = $_GET["orderno"];

        $theurl = "http://172.30.201.238:8080/api/getBookingInfoSwift?filter=order_number,eq," . $searchParam;


        $json = file_get_contents($theurl);
        $obj = json_decode($json);

        $arrecords = $obj->getBookingInfoSwift->records;
        $netw_order = "";
        $install_start = "";
        $install_end = "";
        $install_status = "";
        $ui_id = "";

        if(count($arrecords) > 0){
            $netw_order = $arrecords[0][1];

            $theurl = "http://172.30.201.238:8080/api/getActivitySWIFT?filter[]=order_number,eq," . $searchParam . "&filter[]=activity_type,eq,Installation";
            $json = file_get_contents($theurl);
            $obj = json_decode($json);

            $arrecords = $obj->getActivitySWIFT->records;
            if(count($arrecords) > 0){
                $install_start = $arrecords[0][4];
                $install_end = $arrecords[0][5];
                $install_status = $arrecords[0][3];
                $ui_id = $arrecords[0][6];
            } 

            $returnarr = array(
                "network_order"=>$netw_order,
                "install_start"=>$install_start,
                "install_end"=>$install_end,
                "install_status"=>$install_status,
                "ui_id"=>$ui_id
            );

        } else {
            $returnarr = array("error"=>"record not found");
        }

    } else {
        $returnarr = array("error"=>"bad input");
    }

    echo json_encode($returnarr);

?>