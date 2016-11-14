<?php
require 'DataRequest.php';

//error_reporting(E_ALL);
//ini_set("display_errors","On");
//
//echo $_SERVER['DOCUMENT_ROOT'];


$title = $_REQUEST['title'];
$year = $_REQUEST['year'];
$company = $_REQUEST['company'];
$rating = $_REQUEST['rating'];
$genre = $_REQUEST['genre'];

$genresArry = explode(",",$genre);



if($title !== "" && $year !== "" && $company!=="" && $rating !=="" && count($genresArry)> 0){
    $dataRequest = new DataRequest();
    echo $dataRequest->InsertMovie($title,$year,$company,$rating,$genresArry);
}
else{
    echo "Insufficient Values. Enter all input values.";
}

?>
