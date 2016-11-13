
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
        <h1>This is where you can add Actor and Movie Relation.</h1>
        <h4>Ex: You can search for 'Tom Hanks' or 'Hanks Tom'. It will return Tom Hanks in List of Actors.</h4>
        <h4>Also, You can search for names with ', - .Ex: Json Chu Cheng, J'son Chu-Cheng will return J'son Chu-Cheng.</h4>

    </div>

    <form class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-12" for="searchName">Search Actor (only display latest 50 records. Use search function to filter)</label>
            <input type="text" class="col-sm-3 form-control" id = "searchName" value ="" name="searchName" placeholder="Enter the name of an actor you want to search here...">
        </div>

        <div class="form-group">
            <label class="col-sm-12" for="searchMovie">Search Movie (only display latest 50 records. Use search function to filter)</label>
            <input type="text" class="col-sm-3 form-control" id = "searchMovie" value = "" name="searchMovie" placeholder="Enter the movie you want to search here...">
        </div>


        <div class="form-group">
            <label for="actors">List of Actors</label>
            <select multiple class="form-control" id="actors" name="actors">
            </select>
        </div>

        <div class="form-group">
            <label for="movies">List of Movies</label>
            <select multiple class="form-control" id="movies" name="movies">
            </select>
        </div>

        <div class="form-group">
            <label class="col-sm-3" for="searchMovie">Role</label>
            <input type="text" class="col-sm-3 form-control" id = "role" name="role" placeholder="Enter the role here...">
        </div>



        <div class="form-group">
            <div class="col-sm-3"></div>
            <button type="button" id = "search" class="btn btn-default col-sm-2" name="search">Search</button>
            <div class="col-sm-2"></div>
            <button type="button" id = "submit" class="btn btn-success col-sm-2" name="submit">Submit</button>
        </div>
    </form>





    <div value = "" class="col-sm-12 text-center" id="response"></div>




</div>


<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    (function(){
        var httpRequest;
        var httpRequest2;
        var httpRequest3;


        var request = {
            searchTitle:"",
            searchName:""
        }

        var response = {
            obj: "",
            obj2: "",
            responseMoviesString: "",
            responseDirectorsString: ""

        }

        var record = {
            mid:"",
            did:"",
            role:""
        }

        var httpRequest4;
        var httpRequest5;

        var requestTop20 = {
            objMovieTop20: "",
            movieStringTop20:"",
            objDirectorTop20:"",
            DirectorStringTop20:""
        }


        document.getElementById("submit").onclick = function() { RecordData(); };


        function RecordData(){
            record.did = document.getElementById('actors').value;
            record.mid = document.getElementById('movies').value;
            record.role = document.getElementById('role').value;

            httpRequest3 = new XMLHttpRequest();

            httpRequest3.onreadystatechange = function(){
                if(httpRequest3.readyState === XMLHttpRequest.DONE){
                    if(httpRequest3.status === 200){
                        document.getElementById('response').innerHTML = httpRequest3.responseText;
                    } else{
                        alert('There was a problem with the request.');
                    }
                }
            }

            httpRequest3.open('GET','handler/AddActorMovieHandler.php?movies='+encodeURI(record.mid)+'&actors='+encodeURI(record.did)+'&role='+encodeURI(record.role),true);
            httpRequest3.send();

        }


        document.getElementById("search").onclick = function() { Search(); };

        function Search(){
            document.getElementById('actors').innerHTML = "";
            document.getElementById('movies').innerHTML = "";
            requestTop20.objMovieTop20 = "";
            requestTop20.movieStringTop20 = "";
            requestTop20.objDirectorTop20 = "";
            requestTop20.DirectorStringTop20 = "";
            SearchMovie();
            SearchName();
        }

        function SearchName(){
            request.searchName = document.getElementById('searchName').value;

            if(request.searchName == ""){
                document.getElementById('movies').innerHTML = "";
                return false;
            }

            httpRequest2 = new XMLHttpRequest();

            if (!httpRequest2) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest2.onreadystatechange = alertActorContents;
            httpRequest2.open('GET', 'handler/searchActorHandler.php?searchName='+encodeURI(request.searchName),true);
            httpRequest2.send();
        }

        function alertActorContents() {
            response.responseDirectorsString = "";
            response.obj2 = "";
            if (httpRequest2.readyState === XMLHttpRequest.DONE) {
                if (httpRequest2.status === 200) {
                    //alert(httpRequest2.responseText);
                    response.obj2 = JSON.parse(httpRequest2.responseText);
                    if(response.obj2 != null){
                        for(var i = 0; i<response.obj2.length;i++){
                            response.responseDirectorsString += '<option value="'+response.obj2[i].id+'">' +response.obj2[i].first + ' '+response.obj2[i].last + ' (' +response.obj2[i].dob+ ')</option>';
                        }
                    }
                } else {
                    alert('There was a problem with the request.');
                }
                document.getElementById('actors').innerHTML = response.responseDirectorsString;
            }
        }

        function SearchMovie(){
            request.searchTitle = document.getElementById('searchMovie').value;

            if(request.searchTitle == ""){
                document.getElementById('movies').innerHTML = "";
                return false;
            }

            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = alertMovieContents;
            httpRequest.open('GET', 'handler/searchMovieHandler.php?searchTitle='+encodeURI(request.searchTitle),true);
            httpRequest.send();

        }

        function alertMovieContents() {
            response.responseMoviesString = "";
            response.obj = "";
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    //alert(httpRequest.responseText);
                    response.obj = JSON.parse(httpRequest.responseText);
                    if(response.obj != null){
                        for(var i = 0; i<response.obj.length;i++){
                            response.responseMoviesString += '<option value="'+response.obj[i].id+'">Producer: ' + response.obj[i].company+ ' || Title: ' +response.obj[i].title + ' (' +response.obj[i].year+ ')</option>';
                        }
                    }
                } else {
                    alert('There was a problem with the request.');
                }
                document.getElementById('movies').innerHTML = response.responseMoviesString;
            }
        }


        ///////////////////////////////////////////////////////////////////
        window.onload = LoadTop20;



        function LoadTop20(){
            SelectMovie();
            SelectActor();
        }

        function SelectMovie(){
            httpRequest4 = new XMLHttpRequest();

            if(!httpRequest4){
                alert('Giving up :( Cannot create an XMLHTTP instance.');
                return false;
            }

            httpRequest4.onreadystatechange = alertTop20Movies;
            httpRequest4.open('GET','handler/SelectMovieHandler.php?',true);
            httpRequest4.send();
        }

        function alertTop20Movies() {
            if (httpRequest4.readyState === XMLHttpRequest.DONE) {
                if (httpRequest4.status === 200) {
                    requestTop20.objMovieTop20 = JSON.parse(httpRequest4.responseText);
                    for (var i=0; i<requestTop20.objMovieTop20.length; i++){
                        requestTop20.movieStringTop20 += '<option value="'+requestTop20.objMovieTop20[i].id+'">Producer: ' + requestTop20.objMovieTop20[i].company+ ' || Title: ' +requestTop20.objMovieTop20[i].title + ' (' +requestTop20.objMovieTop20[i].year+ ')</option>';
                    }
                } else {
                    alert('There was a problem with the request.');
                }
                document.getElementById('movies').innerHTML += requestTop20.movieStringTop20;
            }

        }

        function SelectActor(){
            httpRequest5 = new XMLHttpRequest();

            if(!httpRequest5){
                alert('Giving up :( Cannot create an XMLHTTP instance.');
                return false;
            }

            httpRequest5.onreadystatechange = alertTop20Actors;
            httpRequest5.open('GET','handler/SelectActorHandler.php?',true);
            httpRequest5.send();
        }

        function alertTop20Actors() {
            if (httpRequest5.readyState === XMLHttpRequest.DONE) {

                if (httpRequest5.status === 200) {
                    requestTop20.objDirectorTop20 = JSON.parse(httpRequest5.responseText);
                    for (var j=0; j<requestTop20.objDirectorTop20.length; j++){
                        requestTop20.DirectorStringTop20 += '<option value="'+requestTop20.objDirectorTop20[j].id+'">' +requestTop20.objDirectorTop20[j].first +' ' + requestTop20.objDirectorTop20[j].last+ ' (' +requestTop20.objDirectorTop20[j].dob+ ')</option>';
                    }
                } else {
                    alert('There was a problem with the request.');
                }
                document.getElementById('actors').innerHTML += requestTop20.DirectorStringTop20;
            }

    }




    })();
</script>


</body>
</html>
