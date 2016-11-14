<?php
require 'DataRequest.php';

$searchName = trim($_REQUEST['searchName']);

$strExplodes = explode(" ",$searchName);

$searchString = "";


if(count($strExplodes) >0){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchActor($strExplodes); // pass in array
}

//foreach($strExplodes as $val){
//    $searchString .= $val;
//}
//
//
//
//if($searchString !== ""){
//    $dataRequest = new DataRequest();
//    echo $dataRequest->SearchActor($searchString); // pass in array
//}
