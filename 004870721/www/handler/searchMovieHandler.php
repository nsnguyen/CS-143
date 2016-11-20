<?php
require 'DataRequest.php';

$searchTitle = trim($_REQUEST['searchTitle']);

$strExplodes = explode(" ",$searchTitle);

$searchString = "";

foreach($strExplodes as $val){
    $searchString .= $val;
}


if($searchString !== ""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchMovie($searchString);
}

?>