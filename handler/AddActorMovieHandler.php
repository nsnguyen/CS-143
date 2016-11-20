<?php
require 'DataRequest.php';

$aid = $_REQUEST['actors'];
$mid = $_REQUEST['movies'];
$role = $_REQUEST['role'];


if($mid !== "" && $aid !== "" && $role !== ""){

    $dataRequest = new DataRequest();
    echo $dataRequest->InsertActorMovie($mid,$aid,$role);

}
else{
    echo "Select an actor, a movie, and the role they played in.";
}



?>