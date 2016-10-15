<!DOCTYPE html>
<html>
<head>
    <title>Query Textarea</title>
</head>
<body>
    <h1>CS143 - Calculator</h1>
    <h5>Created by Nguyen Si Nguyen UID: 004870721</h5>

    <form method="GET">
        <textarea name="query" cols="60" rows="10"></textarea><br />
        <input type="submit" value="Submit" />
    </form>

    <?php

    $sql = $_GET["query"];

    $servername = "localhost";
    $username = "cs143";
    $password = "";
    $database = "TEST";

    $test = "SELECT * FROM Movie";

    if(!$conn = mysql_connect($servername,$username,$password)){
        echo "Could not connect to mySQL server.";
        exit;
    }

    if(!mysql_select_db($database,$conn)){
        echo "Could not select database";
        exit;
    }

    $result = mysql_query($sql,$conn);


    if(!result){
        echo "DB Error, Could not query the database\n";
        echo "mySQL Error: " . mysql_error();
        exit;
    }

    $i = 0;
    echo '<table border=1 cellspacing=1 cellpadding=2><tr>';
    while ($i < mysql_num_fields($result)){
        $meta = mysql_fetch_field($result,$i);
        echo '<td><b>' . $meta->name . '</b></td>';
        $i = $i + 1;
    }

    echo '<tr>';

    $x = 0;


    # read a row
    while ($row = mysql_fetch_row($result)){
        # for each element in that row
        for($x=0; $x<$i; $x++){
            if ($row[$x] == NULL){
                echo '<td>N/A</td>';}
            else{
                echo '<td>' . $row[$x] . '</td>';
            }
        }
        echo '</td><tr>';
    }
    echo '</tr></table>';


    mysql_free_result($result);
    #mysql_close($conn);

    ?>
</body>

</html>

