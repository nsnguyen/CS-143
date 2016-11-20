<?php
require 'DataRequest.php';


$mid = $_REQUEST['mid'];
$name = $_REQUEST['name'];
$rating = $_REQUEST['rating'];
$comment = $_REQUEST['comment'];


if($mid!=="" && $name!=="" && $rating!=="" && $comment !==""){
    $dataRequest = new DataRequest();
    echo $dataRequest->InsertReviewByMovieId($mid,$name,$rating,$comment);
}

?>
