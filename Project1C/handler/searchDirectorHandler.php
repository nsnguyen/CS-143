<?php
require 'DataRequest.php';

$searchName = trim($_REQUEST['searchName']);

$strExplodes = explode(" ",$searchName);

$searchString = "";

foreach($strExplodes as $val){
    $searchString .= $val;
}



if($searchString !== ""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchDirector($searchString); // pass in array
}
