<?php
require 'DataRequest.php';

$searchTitle = trim($_REQUEST['searchTitle']);


if($searchTitle !== ""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchMovie($searchTitle);
}


?>