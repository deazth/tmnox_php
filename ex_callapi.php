<?php

    // print_r($_GET);
    // if($_GET["a"] === "") echo "a is an empty string\n";
    // if($_GET["a"] === false) echo "a is false\n";
    // if($_GET["a"] === null) echo "a is null\n";
    // if(isset($_GET["a"])) echo "a is set\n";
    // if(!empty($_GET["a"])) echo "a is not empty";


    $theurl = 'http://172.30.201.238:8080/api/getBillAcc?filter=input,eq,nazlinas@unifi';

    $json = file_get_contents($theurl);
    $obj = json_decode($json);
    echo $json;

?>