<!DOCTYPE html>
<html lang="en">
<head>
    <title>Movie Database</title>
</head>

<body>
    <nav>
        <a href = "" title="Add a new actor and/or director information.">Add Actor/Director</a>  |
        <a href = "" title="Add a new movie information.">Add Movie</a> |
        <a href = "" title="Add any comments to movies.">Add Comments</a> |
        <a href = "showActorInfo.php" title="Show Actor information.">Show Actor Info</a> |
        <a href = "showMovieInfo.php" title="Show Movie information.">Show Movie Info</a> |
    </nav>

    <h1>Show Actor Info Page</h1>

    <h2>Search for an Actor</h2>
    <form method="POST">
        <input type="text" id="actorInput" name="input" placeholder="Search for an actor. Leave blank if you want to search for all actors..." size = "100">
        <input type="submit" value="Find Actor(s)" name="submit">

    </form>





</body>

</html>



<?php
if(isset($_POST['submit'])){
    QueryActor();
}


function QueryActor(){
    $server = "localhost";
    $user = "cs143";
    $pass = "";
    $database = "CS143";
    $input = trim($_POST["input"]);


    $mysqli = new mysqli($server,$user,$pass,$database);

    if($mysqli->connect_errno){
        printf($mysqli->connect_error);
        exit();
    }

    $result = $mysqli->query("SELECT * FROM Actor 
                              WHERE first LIKE '%". $input . "%' 
                              OR last LIKE '%".$input."%';");

    if(!$result){
        printf($mysqli->error);
        exit();
    }
    else{
        while($r = $result->fetch_assoc()){
            $rows[] = $r;
        }
        print json_encode($rows);
//        printf('<table border=1 cellspacing=1 cellpadding=1><tr>');
//
//        printf('<td><b>Name</b></td>');
//        printf('<td><b>Movie</b></td>');
//
//        #print headers in bold
//        while ($info = $result->fetch_field()) {#loop header
//            printf('<td><b>' . $info->name . '</b></td>');
//        }
//        printf('</tr><tr>');
//
//        #print data in bolds
//        while ($row = $result->fetch_row()) {#loop data
//            for ($x = 0; $x < $result->field_count; $x++) {
//                $row[$x] == NULL ? printf('<td>N/A</td>') : printf('<td>' . $row[$x] . '</td>');
//            }
//            printf('</td><tr>');
//        }
//        printf('</tr></table>');
//
//        #close connection.
//        $mysqli->close();
    }
}

?>