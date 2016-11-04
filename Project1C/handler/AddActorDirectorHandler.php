<?php
require 'DataRequest.php';

$type = $_REQUEST['ActorDirectorRadios'];
$first = $_REQUEST['first'];
$last = $_REQUEST['last'];
$gender = $_REQUEST['genderRadios'];
$dob = $_REQUEST['dob'];
$dod = $_REQUEST['dod'];


if($type !== "" && $first !=="" && $last !=="" && $gender !=="" && $dob !=""){
    $dataRequest = new DataRequest();
    echo $dataRequest->InsertActorDirector($type,$first,$last,$gender,$dob,$dod);
}
else{
    echo "Insufficient Values. Enter all input values.";
}


?>