<?php
require 'DataRequest.php';

$searchName = trim($_REQUEST['searchTitle']);

if($searchTitle !== ""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchMovie($searchTitle);
}