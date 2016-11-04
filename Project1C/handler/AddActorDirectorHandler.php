<?php
include("model/InsertData.php");

$type = $_REQUEST['ActorDirectorRadios'];
$first = $_REQUEST['first'];
$last = $_REQUEST['last'];
$gender = $_REQUEST['genderRadios'];
$dob = $_REQUEST['dob'];
$dod = $_REQUEST['dod'];


if($type !== "" && $first !=="" && $last !=="" && $gender !=="" && $dob !=""){
    $insertData = new InsertData();
    echo $insertData->InsertActorDirector($type,$first,$last,$gender,$dob,$dod);
}


//if(isset($_GET['submit'])){
////    $type = $_GET['ActorDirectorRadios'];
////    $first = $_GET['first'];
////    $last = $_GET['last'];
////    $gender = $_GET['genderRadios'];
////    $dob = $_GET['dob'];
////    $dod = $_GET['dod'];
//
//
//
//
//    $insertData = new InsertData();
//    echo $insertData->InsertActorDirector($type,$first,$last,$gender,$dob,$dod);
//}

?>