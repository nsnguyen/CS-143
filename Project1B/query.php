<!DOCTYPE html>
<html>
<head>
    <title>Query Textarea</title>
</head>
<body>
    <h1>CS143 - Calculator</h1>
    <h5>Created by Nguyen Si Nguyen UID: 004870721</h5>

    <form method="GET">
        <textarea align="left" name="query" cols="60" rows="10" placeholder="Type in a query..."><?php
            $sql = trim($_GET["query"]);
            echo $sql;
            ?></textarea><br />
        <input type="submit" value="Submit" />
    </form>
    <table border=1 cellspacing=0 cellpadding=1>
        <tr>
    <?php

    #$sql = $_GET["query"];
    $servername = "localhost";
    $username = "cs143";
    $password = "";
    $database = "TEST";

    if(!$conn = mysql_connect($servername,$username,$password)){
        echo "Could not connect to mySQL server.";
        exit;
    }

    if(!mysql_select_db($database,$conn)){
        echo "Could not select database.";
        exit;
    }

    $result = mysql_query($sql,$conn);

    if(!result){
        echo "DB Error, Could not query the database.\n";
        echo "mySQL Error: " . mysql_error();
        exit;
    }

    #Getting attribute names.
    $numFields = mysql_numfields($result);
    for($i=0; $i < $numFields; $i++){
        $obj = mysql_fetch_field($result,$i);
        echo '<td><b>' . $obj->name . '</b></td>';
    }
    echo '<tr>';

    #fetching data each row.
    while($row = mysql_fetch_row($result)){
        for($x=0; $x < $numFields; $x++){
            if ($row[$x] == NULL){
                echo '<td>N/A</td>';}
            else{
                echo '<td>' . $row[$x] . '</td>';
            }
        }
        echo '</td><tr>';
    }
    echo '</tr></table>';

    #free result and close connection.
    mysql_free_result($result);
    mysql_close($conn);

    ?>


        </tr>
    </table>
</body>

</html>

