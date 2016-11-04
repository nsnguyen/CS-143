<?php
include("model/InsertData.php");


$title = $_REQUEST['title'];
$year = $_REQUEST['year'];
$company = $_REQUEST['company'];
$rating = $_REQUEST['rating'];
$genre = $_REQUEST['genre'];
$submit = $_REQUEST['submit'];

//echo $title;
//echo $year;
//echo $company;
//echo $rating;
//echo $genre;
//echo $submit;

$insertData = new InsertData();
$response = $insertData->Test();

echo $response;

//
//
//if(true){
//    $insertData = new InsertData();
//    echo "nice";
//    echo $insertData->InsertMovie($title,$year,$company,$rating,$genre);
//}
//
//



//$title = $_REQUEST['title'];
//$year = $_REQUEST['year'];
//$company = $_REQUEST['company'];
//$rating = $_REQUEST['ratingRadios'];
//$genre = $_REQUEST['genre'];
//$submit = $_REQUEST['submit'];

//echo $title;
//echo $year;
//echo $company;
//echo $rating;
//echo $genre;
//echo $submit;


//$insertData = new InsertData();
//echo $insertData->InsertMovie($title,$year,$company,$rating,$genre);

//if(isset($_REQUEST['submit'])){
////    $title = $_GET['title'];
////    $year = $_GET['year'];
////    $company = $_GET['company'];
////    $rating = $_GET['ratingRadios'];
////    $genre = $_GET['genre'];
//
//    $title = $_REQUEST['title'];
//    $year = $_REQUEST['year'];
//    $company = $_REQUEST['company'];
//    $rating = $_REQUEST['ratingRadios'];
//    $genre = $_REQUEST['genre'];
//
//
//    echo $title;
//    echo $year;
//    echo $company;
//    echo $rating;
//    echo $genre;
//
//    $insertData = new InsertData();
//    echo $insertData->InsertMovie($title,$year,$company,$rating,$genre);
//
//
//}


?>
