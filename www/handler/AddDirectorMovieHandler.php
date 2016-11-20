<?php
require 'DataRequest.php';

$did = $_REQUEST['directors'];
$mid = $_REQUEST['movies'];


if($mid !== "" && $did !== ""){

    $dataRequest = new DataRequest();
    echo $dataRequest->InsertDirectorMovie($mid,$did);

}
else{
    echo "Select a director and a Movie in the lists.";
}



?>