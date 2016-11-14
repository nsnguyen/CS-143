<?php

class DataRequest
{
    public $server = "localhost";
    public $user = "cs143";
    public $pass = "";
    public $database = "CS143";

    public function Test(){
        return "Test";
    }

    public function InsertMovie($title,$year,$company,$rating,$genresArry){
        if(!is_numeric($year)){
            return "Year is not numeric.";
        }

        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);
        }

        $titleE = $mysqli->real_escape_string($title);
        $companyE = $mysqli->real_escape_string($company);

        $checkMovie = $mysqli->query("SELECT * FROM Movie WHERE title = '$titleE' AND year = $year");
        if($checkMovie->num_rows > 0){
            return 'Movie already existed with same title, year.';
        }

        //find max Id. New Movie will be inserted after that. Check MaxMovieId
        $maxMovieId = $mysqli->query("SELECT id FROM MaxMovieID ORDER BY id DESC LIMIT 1;");

        if(!$maxMovieId){
            return ($mysqli->error);
        }
        else{
            $maxId = $maxMovieId->fetch_row();
            $newId = $maxId[0]+1;
        }

        $sqlMovie = "INSERT INTO Movie(id,title,year,rating,company) VALUES($newId,'$titleE',$year,'$rating','$companyE');";
        $sqlUpdateMaxId = "UPDATE MaxMovieID SET id=$newId WHERE id=$maxId[0];";

        if($mysqli->query($sqlMovie)=== TRUE && $mysqli->query($sqlUpdateMaxId)===TRUE){
        }
        else{
            return($mysqli->error);
        }

        for($x = 0; $x <count($genresArry); $x++){
            $sqlMovieGenre = "INSERT INTO MovieGenre(mid,genre) VALUES($newId,'$genresArry[$x]');";
            if($mysqli->query($sqlMovieGenre)===TRUE){
            }
            else{
                return($mysqli->error);
            }
        }


        $mysqli->close();
        return "New Movie and Genre record added succesfully. New Max Id is recorded.";
    }

    public function InsertActorDirector($type,$first,$last,$gender,$dob,$dod){


        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return ($mysqli->connect_error);
        }

        $firstE = $mysqli->real_escape_string($first);
        $lastE = $mysqli->real_escape_string($last);

        //find max Id. New Person Id will be inserted after that. Check MaxPersonId
        $maxPersonId = $mysqli->query("SELECT id FROM MaxPersonID ORDER BY id DESC LIMIT 1;");

        if(!$maxPersonId){
            return ($mysqli->error);
        }
        else{
            $maxId = $maxPersonId->fetch_row();
            $newId = $maxId[0] + 1;
        }


        if($type === "actor"){
            if($dod ===""){
                $sqlPerson = "INSERT INTO Actor(id,last,first,sex,dob,dod) VALUES($newId,'$lastE','$firstE','$gender','$dob',NULL);";
            }
            else{
                $sqlPerson = "INSERT INTO Actor(id,last,first,sex,dob,dod) VALUES($newId,'$lastE','$firstE','$gender','$dob','$dod');";
            }
        }
        else{//director
            if($dod === ""){
                $sqlPerson = "INSERT INTO Director(id,last,first,dob,dod) VALUES($newId, '$lastE','$firstE','$dob',NULL);";
            }
            else{
                $sqlPerson = "INSERT INTO Director(id,last,first,dob,dod) VALUES($newId, '$lastE','$firstE','$dob','$dod');";
            }
        }

        $updateMaxPersonId = "UPDATE MaxPersonID SET ID =$newId WHERE id=$maxId[0];";

        if($mysqli->query($sqlPerson) === TRUE && $mysqli->query($updateMaxPersonId) === TRUE){
            $mysqli->close();
            return "New Person record is added successfully. New Person Id is recorded.";
        }
        else{
            return($mysqli->error);
        }

    }


    public function SelectTop20LatestMovieAdded(){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);
        if($mysqli->connect_errno){
            return($mysqli->connect_error);
            exit();
        }
        $result = $mysqli->query("SELECT * FROM Movie ORDER BY id DESC LIMIT 50;");
        if(!$result){
            return($mysqli->error);
            exit();
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }
    }
    public function SelectTop20LatestActorAdded(){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);
        if($mysqli->connect_errno){
            return($mysqli->connect_error);
            exit();
        }
        $result = $mysqli->query("SELECT * FROM Actor ORDER BY id DESC LIMIT 50;");
        if(!$result){
            return($mysqli->error);
            exit();
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }
    }

    public function SelectTop20LatestDirectorAdded(){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);
        if($mysqli->connect_errno){
            return($mysqli->connect_error);
            exit();
        }
        $result = $mysqli->query("SELECT * FROM Director ORDER BY id DESC LIMIT 50;");
        if(!$result){
            return($mysqli->error);
            exit();
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }
    }

    public function SearchMovie($searchTitle){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        $titleStrip = str_replace(array('.', ',','\'','-'), '' , $searchTitle);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);
        }

      //  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'','')


        //HACKY code.. so the rotation of the string FirstName+LastName to LastName+FirstName is just appending them together..
        $result = $mysqli->query("SELECT * FROM Movie WHERE CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(title,'\'',''),'-',''),'.',''),'\,',''),'\'',''),' ',''),',',''),
                                    REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(title,'\'',''),'-',''),'.',''),'\,',''),'\'',''),' ',''),',','')) LIKE '%$titleStrip%' ORDER BY year DESC");

        if(!$result){
            return($mysqli->error);
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }

    }

    public function SearchMovieById($mid){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);
        }

        $result = $mysqli->query("SELECT M.title,M.year,M.rating,M.company,D.director
                                          ,G.genre,A.first actorfirst,A.last actorlast,MA.role,MA.aid
                                            FROM Movie M
                                            LEFT JOIN (SELECT mid, GROUP_CONCAT(' ',DD.first, ' ', DD.last) director
                                                        FROM MovieDirector MD
                                                        LEFT JOIN Director DD ON MD.did=DD.id
                                                        WHERE MD.mid=$mid GROUP BY mid) D ON M.id=D.mid
                                            LEFT JOIN (SELECT mid, GROUP_CONCAT(' ',genre) genre FROM MovieGenre Where mid=$mid GROUP BY mid) G ON M.id=G.mid
                                            LEFT JOIN MovieActor MA ON M.id=MA.mid
                                            LEFT JOIN Actor A ON MA.aid=A.id 
                                            WHERE M.id=$mid
                                              ;");


        if(!$result){
            return ($mysqli->error);
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }
    }



    public function SearchActor($searchNameArry){

        foreach ($searchNameArry as &$value) {
            $value = "'%".str_replace(array('.', ',','\'','-'), '' , $value)."%'";
        }
        unset($value);



        //$nameStrip = str_replace(array('.', ',','\'','-'), '' , $searchName);


        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);

        }

        $firstSearch = "first LIKE ";
        $lastSearch = "last LIKE ";


        $firstSearch .= join(" OR first LIKE ",$searchNameArry);
        $lastSearch .= join(" OR last LIKE ", $searchNameArry);


        if(count($searchNameArry)>1){
            $result = $mysqli->query("SELECT * FROM Actor WHERE("
                .$firstSearch.") AND (".$lastSearch.")");
        }
        else{
            $result = $mysqli->query("SELECT * FROM Actor WHERE("
                .$firstSearch.") OR (".$lastSearch.")");
        }

//        return "SELECT * FROM Actor WHERE("
//        .$firstSearch.") AND (".$lastSearch.")";

        //HACKY code.. so the rotation of the string FirstName+LastName to LastName+FirstName is just appending them together..
        // So this string will always return the person regardless of FirstName or LastName
        //Ex: Tom Hanks, Hanks Tom - will return Tom Hanks because it exists in TomHanksTomHanks

       // REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'','')

        //$result = $mysqli->query("SELECT * FROM Actor WHERE CONCAT(REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ',''),
        //                          REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ','')) LIKE '%$nameStrip%' ORDER BY dob DESC");



        if(!$result){
            return ($mysqli->error);
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }

    }


    public function SearchActorById($aid){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);
        }

        $result = $mysqli->query("SELECT A.id,A.last,A.first,A.sex,A.dod,A.dob
                                        ,MA.mid,MA.aid,MA.role
                                        ,M.title,M.year,M.rating,M.company
                                  FROM Actor A 
                                  LEFT JOIN MovieActor MA ON A.id=MA.aid 
                                  LEFT JOIN Movie M ON MA.mid=M.id 
                                  WHERE A.id=$aid");

        if(!$result){
            return ($mysqli->error);
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }

    }


    public function SearchDirector($searchNameArry){

        foreach ($searchNameArry as &$value) {
            $value = "'%".str_replace(array('.', ',','\'','-'), '' , $value)."%'";
        }
        unset($value);


        //$nameStrip = str_replace(array('.', ',','\'','-'), '' , $searchName);


        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);

        }

        $firstSearch = "first LIKE ";
        $lastSearch = "last LIKE ";


        $firstSearch .= join(" OR first LIKE ",$searchNameArry);
        $lastSearch .= join(" OR last LIKE ", $searchNameArry);


        if(count($searchNameArry)>1){
            $result = $mysqli->query("SELECT * FROM Director WHERE("
                .$firstSearch.") AND (".$lastSearch.")");
        }
        else{
            $result = $mysqli->query("SELECT * FROM Director WHERE("
                .$firstSearch.") OR (".$lastSearch.")");
        }

//        return "SELECT * FROM Director WHERE("
//        .$firstSearch.") AND (".$lastSearch.")";


        //HACKY code.. so the rotation of the string FirstName+LastName to LastName+FirstName is just appending them together..
        // So this string will always return the person regardless of FirstName or LastName
        //Ex: Tom Hanks, Hanks Tom - will return Tom Hanks because it exists in TomHanksTomHanks

        // REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'','')

//        $result = $mysqli->query("SELECT * FROM Director WHERE CONCAT(REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ',''),
//                                  REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ','')) LIKE '%$nameStrip%' ORDER BY dob DESC");

        if(!$result){
            return ($mysqli->error);
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }

    }


    public function InsertActorMovie($mid,$aid,$role){

        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);

        }

        $checkMid = $mysqli->query("SELECT * FROM MovieActor WHERE aid = $aid AND mid = $mid AND role LIKE '%$role%';");

        if(!$checkMid){
            return ($mysqli->error);
        }
//        else{
//            while($r = $checkMid->fetch_assoc()){
//                $rows[] = $r;
//            }
//            $mysqli->close();
//            return json_encode($rows);
//        }
//    }

        if($checkMid->num_rows > 0){
            return "Movie and Actor and Role relation is already existed.";
        }
        else{
            $actorMovieRelation = "INSERT INTO MovieActor(mid,aid,role) VALUES($mid,$aid,'$role');";


            if($mysqli->query($actorMovieRelation) === TRUE){
                $mysqli->close();
                return "New Actor and Movie relation is added successfully.";
            }
            else{
                return($mysqli->error);
            }
        }
    }

    public function InsertDirectorMovie($mid,$did){
        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);

        }

        $checkMid = $mysqli->query("SELECT * FROM MovieDirector WHERE did = $did AND mid = $mid;");

        if(!$checkMid){
            return ($mysqli->error);
        }
//        else{
//            while($r = $checkMid->fetch_assoc()){
//                $rows[] = $r;
//            }
//            $mysqli->close();
//            return json_encode($rows);
//        }



        if($checkMid->num_rows > 0){
            return "Movie and Director relation is already existed.";
        }
        else{
            $directorMovieRelation = "INSERT INTO MovieDirector(mid,did) VALUES($mid,$did);";


            if($mysqli->query($directorMovieRelation) === TRUE){
                $mysqli->close();
                return "New Director and Movie relation is added successfully.";
            }
            else{
                return($mysqli->error);
            }
        }
    }


    public function SearchReviewByMovieId($mid){

        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);
        }

        $result = $mysqli->query("SELECT * 
                                  FROM Review R1 LEFT JOIN
                                  (SELECT mid, AVG(rating) averagerating FROM Review GROUP BY mid) R2
                                  ON R1.mid = R2.mid
                                  WHERE R1.mid=$mid");

        if(!$result){
            return ($mysqli->error);
        }
        else{
            while($r = $result->fetch_assoc()){
                $rows[] = $r;
            }
            $mysqli->close();
            return json_encode($rows);
        }
    }

    public function InsertReviewByMovieId($mid,$name,$rating,$comment){

        if(!is_numeric($rating)){
            return "Year is not numeric.";
        }
        elseif($rating > 5 || $rating <0){
            return "Rating should be between 0 and 5.";
        }

        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);
        }

        $result = $mysqli->query("INSERT INTO Review(name,time,mid,rating,comment) VALUES('$name',NOW(),$mid,$rating,'$comment');");

        if(!$result){
            return ($mysqli->error);
        }
        else{
            $mysqli->close();
            return "A Review is added sucessfully";
        }

    }



}