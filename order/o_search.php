<?php
    header('Content-Type: application/json');
    $returnarr = array();
    $searchParam = "";

    // verify the input
    if(isset($_GET["orderno"])){
        $searchParam = $_GET["orderno"];

        $theurl = "http://172.30.201.238:8080/api/getInfoOrder?filter=Siebel_Order_Number,eq," . $searchParam;

        $json = file_get_contents($theurl);
        $obj = json_decode($json);

        $arrecords = $obj->getInfoOrder->records;
        $acc_name = "";
        $order_type = "";
        $order_status = "";

        $svcsarray = array();
        $reccount = 0;

        foreach($arrecords as $srecord){
            
            $acc_name = $srecord[2];
            $order_type = $srecord[1];
            $order_status = $srecord[3];

            $svc = array(
                "svc_id" => $srecord[4],
                "product_name" => $srecord[7],
                "product_code" => $srecord[5],
                "product_desc" => $srecord[6],
            );

            array_push($svcsarray, $svc);
            
            $reccount++;
        }

        if($reccount > 0){
            $returnarr = array("acc_name"=>$acc_name,
                "order_type"=>$order_type,
                "order_status"=>$order_status,
                "services"=>$svcsarray );
        } else {
            $returnarr = array("error"=>"record not found");
        }
    } else {
        $returnarr = array("error"=>"bad input");
    }

    echo json_encode($returnarr);

?>