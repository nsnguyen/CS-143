<?php
require 'DataRequest.php';

$type = $_REQUEST['ActorDirectorRadios'];
$first = $_REQUEST['first'];
$last = $_REQUEST['last'];
$gender = $_REQUEST['genderRadios'];
$dob = $_REQUEST['dob'];
$dod = $_REQUEST['dod'];


if($type !== "" && $first !=="" && $last !=="" && $gender !=="" && $dob !==""){

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dob))
    {
        echo "Date of birth date format is invalid. Please use YYYY-MM-DD format.";
    }
    else if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dod) && $dod!=="")
    {
        echo "Date of death date format is invalid. Please use YYYY-MM-DD format.";
    }
    else{
        $dataRequest = new DataRequest();
        echo $dataRequest->InsertActorDirector($type,$first,$last,$gender,$dob,$dod);
    }
}
else{
    echo "Insufficient Values. Enter all input values.";
}

?>