<?php
require 'DataRequest.php';

$aid = trim($_REQUEST['aid']);


if($aid !==""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchActorById($aid);
}

?>