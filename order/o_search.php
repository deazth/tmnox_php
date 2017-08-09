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
            
            $acc_name = $srecord[1];
            $order_status = $srecord[2];
            $svc_id = $srecord[3];
            $prod_code = $srecord[4];
            $prod_desc = $srecord[5];
            $prod_name = $srecord[6];

            $svc = array(
                "svc_id" => $srecord[3],
                "product_name" => $srecord[6]
            );

            array_push($svcsarray, $svc);
            
            $reccount++;
        }

        if($reccount > 0){
            array_push($returnarr, array("acc_name"=>$acc_name,
                "order_type"=>$order_type,
                "order_status"=>$order_status,
                "services"=>$svcsarray ));
        } else {
            array_push($returnarr, array("error"=>"record not found"));
        }
    } else {
        array_push($returnarr, array("error"=>"bad input"));
    }

    echo json_encode($returnarr);

?>