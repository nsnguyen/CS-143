
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
                <li><a href="addComment.php">Add Comment</a></li>
                <li><a href="addActorMovie.php">Add Actor/Movie Relation</a></li>
                <li><a href="addDirectorMovie.php">Add Director/Movie Relation</a></li>
                <li><a href="Search.php">Search</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter">
        <h1>This is where you can search and see Actors and Movies basing on your search string.</h1>

    </div>

    <form class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-12" for="searchString">Search</label>
            <input type="text" class="col-sm-3 form-control" id = "searchString" value ="" name="searchString" placeholder="Enter the search string you want to search here...">
        </div>


        <div class="col-sm-12 text-center">

            <button type="button" id = "submit" class="btn btn-primary" name="submit">Search</button>
        </div>



    </form>


    <div class="row">


        <div id="printActorName" class="col-sm-6">
            <table id="actorNames" class = "table">
            </table>

        </div>
        <div id="printMovieName" class="col-sm-6">
            <table id="movieNames" class = "table">
            </table>
        </div>


    </div>



</div>



    <div value = "" class="col-sm-12 text-center" id="response"></div>







<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    (function(){

        var httpRequest;
        var httpRequest1;

        var request = {
            searchString : ""
        };

        var response = {
            actorsObj: "",
            actorsString: "",
            actorRowCounter:0,
            movieRowCounter:0,
            moviesObj:"",
            moviesString:""
        };


        document.getElementById('submit').onclick = function(){ GetActors(); GetMovies();};


        function GetActors(){
            request.searchString = document.getElementById('searchString').value;


            if(request.searchString == ""){
                document.getElementById('actorNames').innerHTML = "";
                return false;
            }


            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = function(){
                response.actorsString = '<thead><tr><th>#</th><th>Actor Full Names</tr></thead>';
                response.actorsObj = "";
                response.actorRowCounter = 0;
                if(httpRequest.readyState === XMLHttpRequest.DONE){
                    if(httpRequest.status === 200){
                        response.actorsObj = JSON.parse(httpRequest.responseText);
                        if(response.actorsObj !== null){
                            for(var i=0; i<response.actorsObj.length;i++){
                                response.actorRowCounter += 1;
                                response.actorsString += '<tbody><tr><th scope="row">'+response.actorRowCounter+'</th><td><a href="showActorInfo.php?aid='+ response.actorsObj[i].id +'">'+response.actorsObj[i].first + ' ' +response.actorsObj[i].last +' ('+ response.actorsObj[i].dob + ')</td></tr>'
                            }
                        }
                    } else{
                        alert('There was a problem with the request.');
                    }
                    document.getElementById('actorNames').innerHTML = response.actorsString;
                }
            }

            httpRequest.open('GET', 'handler/searchActorHandler.php?searchName='+encodeURI(request.searchString),true);
            httpRequest.send();
        }


        function GetMovies(){
            request.searchString = document.getElementById('searchString').value;


            if(request.searchString == ""){
                document.getElementById('movieNames').innerHTML = "";
                return false;
            }

            httpRequest1 = new XMLHttpRequest();

            if (!httpRequest1) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest1.onreadystatechange = function(){
                response.moviesString = '<thead><tr><th>#</th><th>Movie Names</th></tr></thead>';
                response.moviesObj = "";
                response.movieRowCounter = 0;
                if(httpRequest1.readyState === XMLHttpRequest.DONE){
                    if(httpRequest1.status === 200){
                        response.moviesObj = JSON.parse(httpRequest1.responseText);
                        if(response.moviesObj !== null){
                            for(var i=0; i<response.moviesObj.length;i++){
                                response.movieRowCounter += 1;
                                response.moviesString += '<tbody><tr><th scope="row">'+response.movieRowCounter+'</th><td><a href="showMovieInfo.php?mid='+response.moviesObj[i].id+'">'+response.moviesObj[i].title +' ('+ response.moviesObj[i].year + ')</td></tr></tbody>'
                            }
                        }
                    } else{
                        alert('There was a problem with the request.');
                    }
                    document.getElementById('movieNames').innerHTML = response.moviesString;
                }
            }

            httpRequest1.open('GET', 'handler/searchMovieHandler.php?searchTitle='+encodeURI(request.searchString),true);
            httpRequest1.send();

        }


    })();
</script>


</body>
</html>




