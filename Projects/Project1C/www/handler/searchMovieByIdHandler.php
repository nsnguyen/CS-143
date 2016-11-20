<?php
require 'DataRequest.php';

$mid = trim($_REQUEST['mid']);


if($mid !==""){
    $dataRequest = new DataRequest();
    echo $dataRequest->SearchMovieById($mid);
}

?>