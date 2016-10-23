<!DOCTYPE html>
<html>
<head>
    <title>Query Textarea</title>
</head>
<body>
    <h1>CS143 - Calculator</h1>
    <h5>Created by Nguyen Si Nguyen UID: 004870721</h5>

    <h4>Please note that the query is case sensitive.</h4>
    <h5>Example Query: Show all attributes for first 5 tuples: SELECT * FROM Movie LIMIT 5;</h5>
    <form method="GET">
        <textarea align="left" name="query" cols="60" rows="10" placeholder="Type in a query..."><?php
            $sql = trim($_GET["query"]);
            printf($sql);
            ?></textarea><br />
        <input type="submit" value="Submit" />
    </form>

    <br/><?php
    $server = "localhost";
    $user = "cs143";
    $psswrd = "";
    $database = "CS143";

    $mysqli = new mysqli($server,$user,$psswrd,$database);

    if($mysqli-> connect_errno){ #Check for connection error.
        printf($mysqli->connect_error);
        exit();
    }

    $result =  $mysqli->query($sql);

    if(!$result){ #Check if query has an error.
        printf($mysqli->error);
        exit();
    }
    else{
        printf('<table border=1 cellspacing=1 cellpadding=1><tr>');

        #print headers in bold
        while ($info = $result->fetch_field()) {#loop header
            printf('<td><b>' . $info->name . '</b></td>');
        }
        printf('</tr><tr>');

        #print data in bolds
        while ($row = $result->fetch_row()) {#loop data
            for ($x = 0; $x < $result->field_count; $x++) {
                $row[$x] == NULL ? printf('<td>N/A</td>') : printf('<td>' . $row[$x] . '</td>');
            }
            printf('</td><tr>');
        }
        printf('</tr></table>');

        #close connection.
        $mysqli->close();
    }

    ?>
</body>
</html>

