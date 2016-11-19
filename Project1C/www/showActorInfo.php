<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Movie to Actor Relation</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/MyTemplate.css" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CS143 Movie Database</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="addActorDirector.php">Add Actor/Director</a></li>
                <li><a href="addMovie.php">Add Movie</a></li>
                <li><a href="addActorMovie.php">Add Actor/Movie Relation</a></li>
                <li><a href="addDirectorMovie.php">Add Director/Movie Relation</a></li>
                <li><a href="Search.php">Search</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter">
        <h1>Actor Information</h1>

    </div>

    <legend>Actor Information</legend>

    <div class="row">
        <div class="col-sm-2">
            <h4><b>First Name:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="FirstName"></h4>
        </div>
        <div class="col-sm-2">
            <h4><b>Last Name:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="LastName"></h4>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-2">
            <h4><b>Date of Birth:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="DOB"></h4>
        </div>
        <div class="col-sm-2">
            <h4><b>Date of Death:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="DOD"></h4>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-2">
            <h4><b>Gender:</b></h4>
        </div>
        <div class="col-sm-2">
            <h4 id="Gender"></h4>
        </div>
    </div>

    <br>
    <legend>Movies that Actor played in</legend>

    <div class="row">
        <div class="col-sm-12">
            <table id = "movies" class="table">
            </table>
        </div>
    </div>

</div>



<div value = "" class="col-sm-12 text-center" id="response"></div>




<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    (function(){

        window.onload = GetActorInfo;

        var request = {
            aid: ""
        }

        var response = {
            obj: "",
            rowCounter: 0,
            moviesString: ""
        }

        request.aid = getQueryVariable("aid");

        function GetActorInfo(){

            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = function(){
                response.moviesString = '<thead><tr><th>#</th><th>Movie which Actor played in</th><th>Role</th></tr></thead>';
                response.obj = "";
                response.rowCounter = 0;
                if(httpRequest.readyState === XMLHttpRequest.DONE){
                    if(httpRequest.status === 200){
                        //alert(httpRequest.responseText);
                        response.obj = JSON.parse(httpRequest.responseText);
                        //alert(response.obj[0].first);
                        if(response.obj !== null){
                            for(var i = 0; i<response.obj.length;i++){
                                response.rowCounter += 1;
                                if(response.obj[i].mid != null){
                                    response.moviesString += '<tbody><tr><th scope="row">'+response.rowCounter+'</th><td><a href="showMovieInfo.php?mid='+response.obj[i].mid+'">'+response.obj[i].title +' ('+ response.obj[i].year + ')</td><td>'+response.obj[i].role +'</td></tr></tbody>'
                                }
                            }
                        }
                    } else{
                        alert('There was a problem with the request.');
                    }

                    document.getElementById('FirstName').innerHTML = response.obj[0].first;
                    document.getElementById('LastName').innerHTML = response.obj[0].last;
                    document.getElementById('Gender').innerHTML = response.obj[0].sex;
                    document.getElementById('DOB').innerHTML = response.obj[0].dob;
                    document.getElementById('DOD').innerHTML = (response.obj[0].dod == null)? "Not dead yet":response.obj[0].dod;

                    document.getElementById('movies').innerHTML = response.moviesString;

                }
            }

            httpRequest.open('GET', 'handler/searchActorByIdHandler.php?aid='+request.aid,true);
            httpRequest.send();

        }

        function getQueryVariable(variable)
        {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }

    })();


</script>



</body>
</html>




