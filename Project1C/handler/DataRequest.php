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

    public function InsertMovie($title,$year,$company,$rating,$genre){
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
        $sqlMovieGenre = "INSERT INTO MovieGenre(mid,genre) VALUES($newId,'$genre');";
        $sqlUpdateMaxId = "UPDATE MaxMovieID SET id=$newId WHERE id=$maxId[0];";


        if($mysqli->query($sqlMovie)=== TRUE && $mysqli->query($sqlMovieGenre)===TRUE && $mysqli->query($sqlUpdateMaxId)===TRUE){
            $mysqli->close();
            return "New Movie and Genre record added succesfully. New Max Id is recorded.";
        }
        else{
            return($mysqli->error);
        }
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

    public function SearchActor($searchName){

        $nameStrip = str_replace(array('.', ',','\'','-'), '' , $searchName);


        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);

        }

        //HACKY code.. so the rotation of the string FirstName+LastName to LastName+FirstName is just appending them together..
        // So this string will always return the person regardless of FirstName or LastName
        //Ex: Tom Hanks, Hanks Tom - will return Tom Hanks because it exists in TomHanksTomHanks

       // REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'','')

        $result = $mysqli->query("SELECT * FROM Actor WHERE CONCAT(REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ',''),
                                  REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ','')) LIKE '%$nameStrip%' ORDER BY dob DESC");

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

    public function SearchDirector($searchName){
        $nameStrip = str_replace(array('.', ',','\'','-'), '' , $searchName);


        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            return($mysqli->connect_error);

        }

        //HACKY code.. so the rotation of the string FirstName+LastName to LastName+FirstName is just appending them together..
        // So this string will always return the person regardless of FirstName or LastName
        //Ex: Tom Hanks, Hanks Tom - will return Tom Hanks because it exists in TomHanksTomHanks

        // REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'','')

        $result = $mysqli->query("SELECT * FROM Director WHERE CONCAT(REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ',''),
                                  REPLACE(CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(first,'\'',''),'-',''),'.',''),'\,',''),'\'',''),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(last,'\'',''),'-',''),'.',''),'\,',''),'\'','')),' ','')) LIKE '%$nameStrip%' ORDER BY dob DESC");

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



}