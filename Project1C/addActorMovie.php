
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

<body onload="">

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
                <li><a href="search.php">Search</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter">
        <h1>This is where you can add Actor and Movie Relation.</h1>
        <h4>Select Actor and Movie relationship. Add their roles. </h4>

    </div>

    <form class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-3" for="searchName">Search Actor</label>
            <input type="text" class="col-sm-3 form-control" id = "searchName" name="searchName">
        </div>

        <div class="form-group">
            <label class="col-sm-3" for="searchMovie">Search Movie</label>
            <input type="text" class="col-sm-3 form-control" id = "searchMovie" name="searchMovie">
        </div>


        <div class="form-group">
            <label for="actors">List of Actors</label>
            <select multiple class="form-control col-sm-3" id="actors" name="actors">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="movies">List of Movies</label>
            <select multiple class="form-control col-sm-3" id="movies" name="actors">
            </select>
        </div>

<!--        <div class="form-group">-->
<!--            <label class="col-sm-3" for="actors">List of Actors</label>-->
<!--            <select id="actors" name="actors" class="col-sm-6"></select>-->
<!--        </div>-->
<!---->
<!---->
<!---->
<!--        <div class="form-group">-->
<!--            <label class="col-sm-3" for="movies">List of Movies</label>-->
<!--            <select id="movies" name="movies" class="col-sm-6"></select>-->
<!---->
<!--        </div>-->

        <div class="form-group">
            <div class="col-sm-3"></div>
            <button type="button" id = "submit" class="btn btn-success col-sm-2" name="submit">Submit</button>
        </div>
    </form>





    <div class="col-sm-12 text-center" id="response"></div>




</div>


<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    (function(){
        var httpRequest;

//        var request = {
//            obj1: "",
//            moviesString: "",
//            obj2: "",
//            actorsString: "",
//            temp:"",
//            searchMovie:""
//        };

        var request = {
            searchTitle:"",
            searchName:""
        }

        var response = {
            obj: "",
            responseString: ""

        }

        document.getElementById("submit").onclick = function() { Search(); };

        function Search(){
            SearchMovie();
        }

        function SearchName(){

        }



        function SearchMovie(){
            request.searchTitle = document.getElementById('searchMovie').value;

            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('GET', 'handler/searchMovieHandler.php?searchTitle='+encodeURI(request.searchTitle),true);
            httpRequest.send();

        }

        function alertContents() {
            response.responseString = "";
            response.obj = "";
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    //alert(httpRequest.responseText);
                    response.obj = JSON.parse(httpRequest.responseText);
                    if(response.obj != null){
                        for(var i = 0; i<response.obj.length;i++){
                            response.responseString += '<option value="'+response.obj[i].id+'">' +response.obj[i].title + ' (' +response.obj[i].year+ ')</option>';
                        }
                    }
                } else {
                    alert('There was a problem with the request.');
                }
                document.getElementById('movies').innerHTML = response.responseString;
            }
        }

/////////////////////////////////////////////////////////////////////
//        //window.onload = LoadNames;
//
//        function LoadNames(){
//            SelectMovie();
//            SelectActor();
//        }
//
//        function SelectMovie(){
//            httpRequest1 = new XMLHttpRequest();
//
//            if(!httpRequest1){
//                alert('Giving up :( Cannot create an XMLHTTP instance.');
//                return false;
//            }
//
//            httpRequest1.onreadystatechange = alertContentsMovie;
//            httpRequest1.open('GET','handler/SelectMovieHandler.php?',true);
//            httpRequest1.send();
//        }
//
//        function alertContentsMovie() {
//            if (httpRequest1.readyState === XMLHttpRequest.DONE) {
//                if (httpRequest1.status === 200) {
//                    request.obj1 = JSON.parse(httpRequest1.responseText);
//                    for (var i=0; i<request.obj1.length; i++){
//                        request.moviesString += '<option value="'+request.obj1[i].id+'">' +request.obj1[i].title + ' (' +request.obj1[i].year+ ')</option>';
//                    }
//                } else {
//                    alert('There was a problem with the request.');
//                }
//                document.getElementById('movies').innerHTML += request.moviesString;
//            }
//            delete request.obj1;
//            delete request.moviesString;
//
//            console.log(request.obj1);
//            console.log(request.moviesString);
//
//        }
//
//        function SelectActor(){
//            httpRequest2 = new XMLHttpRequest();
//
//            if(!httpRequest2){
//                alert('Giving up :( Cannot create an XMLHTTP instance.');
//                return false;
//            }
//
//            httpRequest2.onreadystatechange = alertContentsActor;
//            httpRequest2.open('GET','handler/SelectActorHandler.php?',true);
//            httpRequest2.send();
//        }
//
//        function alertContentsActor() {
//            if (httpRequest2.readyState === XMLHttpRequest.DONE) {
//
//                if (httpRequest2.status === 200) {
//                    request.obj2 = JSON.parse(httpRequest2.responseText);
//                    for (var j=0; j<request.obj2.length; j++){
//                        request.actorsString += '<option value="'+request.obj2[j].id+'">' +request.obj2[j].first +' ' + request.obj2[j].last+ ' (' +request.obj2[j].dob+ ')</option>';
//                    }
//                } else {
//                    alert('There was a problem with the request.');
//                }
//                document.getElementById('actors').innerHTML += request.actorsString;
//            }
//            delete request.obj2;
//            delete request.actorsString;
//
//            console.log(request.obj2);
//            console.log(request.actorsString);
//    }



    })();
</script>


</body>
</html>
