<?php
    header('Content-Type: application/json');
    $returnarr = array();
    $orderno = "";

    function getSwiftActivityStatus($o_num, $act_id){
        $f_sw_url = "http://172.30.201.238:8080/api/getActivitySWIFT?filter[]=order_number,eq," 
            . $o_num . "&filter[]=activity_id,eq," . $act_id;

        $f_sw_js = file_get_contents($f_sw_url);
        $f_sw_obj = json_decode($f_sw_js);

        $arrecords = $f_sw_obj->getActivitySWIFT->records;

        if(count($arrecords) > 0){
            return $arrecords[0][3];
        } else {
            return "";
        }
    }

    // verify the input
    if(isset($_GET["orderno"])){
        $orderno = $_GET["orderno"];

        $f_sb_url = "http://172.30.201.238:8080/api/getOrderActivitySiebel?filter=siebel_order,eq," . $orderno;

        $f_sb_js = file_get_contents($f_sb_url);
        $f_sb_obj = json_decode($f_sb_js);
        // print_r($f_sb_obj);

        $sblRecords = $f_sb_obj->getOrderActivitySiebel->records;

        // print_r($sblRecords);

        foreach($sblRecords as $ssbl){
            $s_a_id = $ssbl[1];
            $s_a_name = $ssbl[3];
            $s_a_status = $ssbl[2];

            $sw_a_status = getSwiftActivityStatus($orderno, $s_a_id);

            array_push($returnarr, array(
                "act_id" => $s_a_id,
                "act_name" => $s_a_name,
                "sbl_status" => $s_a_status,
                "swf_status" => $sw_a_status
            ));
        }

    } else {
        $returnarr = array("error"=>"bad input");
    }

    echo json_encode($returnarr);

?>