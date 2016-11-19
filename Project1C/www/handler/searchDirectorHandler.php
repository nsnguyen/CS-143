<?php
require 'DataRequest.php';

$searchName = trim($_REQUEST['searchName']);

$strExplodes = explode(" ",$searchName);

$searchString = "";

if(count($strExplodes) >0){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchDirector($strExplodes); // pass in array
}
