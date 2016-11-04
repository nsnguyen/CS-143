<?php

class InsertData
{
    public $server = "localhost";
    public $user = "cs143";
    public $pass = "";
    public $database = "CS143";


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





    public function SelectMovie($title,$year,$company,$rating,$genre){


        $mysqli = new mysqli($this->server,$this->user,$this->pass,$this->database);

        if($mysqli->connect_errno){
            printf($mysqli->connect_error);
            exit();
        }


        $result = $mysqli->query("SELECT * FROM Movie;");

        if(!$result){
            printf($mysqli->error);
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
}