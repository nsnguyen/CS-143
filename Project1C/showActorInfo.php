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
        <input type="text" id="actorInput" name="query" placeholder="Search for an actor. Leave blank if you want to search for all actors..." size = "100">
        <input type="submit" value="Find Actor(s)">

    </form>





</body>

</html>



<?php
$server = "localhost";
$user = "cs143";
$pass = "";
$database = "CS143";

$mysqli = new mysqli($server,$user,$pass,$database);

if($mysqli->connect_errno){
    printf($mysqli->connect_error);
    exit();
}

$result = $mysqli->query("SELECT * FROM Actor;");


?>