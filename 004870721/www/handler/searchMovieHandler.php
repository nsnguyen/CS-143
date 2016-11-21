<?php
require 'DataRequest.php';

$searchTitle = trim($_REQUEST['searchTitle']);

$strExplodes = explode(" ",$searchTitle);

$searchString = "";

if(count($strExplodes) >0){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchMovie($strExplodes);
}

?>