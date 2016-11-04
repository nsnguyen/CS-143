<?php
require 'DataRequest.php';

$search = trim($_REQUEST['searchTitle']);


if($search !== ""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchMovie($search);
}


?>