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
        <h1>Movie Information</h1>

    </div>

    <legend>Movie Information</legend>

    <div class="row">
        <div class="col-sm-2">
            <h4><b>Movie Title:</b></h4>
        </div>
        <div class="col-sm-10">
            <h4 id="title"></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <h4><b>Year:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="year"></h4>
        </div>
        <div class="col-sm-2">
            <h4><b>Rating:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="rating"></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <h4><b>Producer:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="company"></h4>
        </div>
        <div class="col-sm-2">
            <h4><b>Director:</b></h4>
        </div>
        <div class="col-sm-4">
            <h4 id="director"></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <h4><b>Genre:</b></h4>
        </div>
        <div class="col-sm-10">
            <h4 id="genre"></h4>
        </div>
    </div>

    <br>
    <legend>Actors In Movie</legend>

    <div class="row">
        <div class="col-sm-12">
            <table id = "actors" class="table">
            </table>
        </div>
    </div>


    <br>
    <legend>Reviews</legend>

    <div class="row">
        <div class="col-sm-12">
            <table id = "reviews" class="table">
            </table>
        </div>
    </div>

    <legend>Add Review Here</legend>

    <div class="row">
        <div class=form-group>
            <label for="reviewer" class="col-sm-2">Reviewer Name</label>
            <input id="reviewer" input="text" name="reviewer" class="col-sm-10" placeholder="Put your name here..">
        </div>
        <br>
        <br>
    </div>

    <div class="row">
        <div class="form-group">
            <label class="col-sm-2">Rating</label>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="rating" id="rRadio1" value="1">
                    1
                </label>
            </div>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="rating" id="rRadio2" value="2">
                    2
                </label>
            </div>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="rating" id="rRadio3" value="3">
                    3
                </label>
            </div>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="rating" id="rRadio4" value="4">
                    4
                </label>
            </div>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="rating" id="rRadio5" value="5" checked>
                    5
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="average" class="col-sm-2">Avg Rating:</label>
            <div id="average"></div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" rows="5" id="comment" placeholder="Put your thoughts here.."></textarea>
        </div>
    </div>

    <div class="col-sm-12 text-center" id ="button"><button type="button" id = "submit" class="btn btn-primary" name="submit">Submit Review</button></div>
</div>

<div value = "" class="col-sm-12 text-center" id="response"></div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    (function(){

        window.onload = onload;

        document.getElementById('submit').onclick = function(){ InsertMovieReviews(); };

        var request = {
            mid: "",
            reviewer:"",
            comment:"",
            rating:""

        }

        var response = {
            obj: "",
            rowCounter: 0,
            actorsString: "",
            reviewsString:"",
            directorsString: "",
            genresString:"",
            averageRating:0
        }

        request.mid = getQueryVariable("mid");


        function onload(){
            GetMovieInfo();
            GetMovieReviews();
        }

        function GetMovieInfo(){

            var httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = function(){
                response.actorsString = '<thead><tr><th>#</th><th>Actor Names</th><th>Role</th></tr></thead>';
                response.obj = "";
                response.rowCounter = 0;
                if(httpRequest.readyState === XMLHttpRequest.DONE){
                    if(httpRequest.status === 200){
                        response.obj = JSON.parse(httpRequest.responseText);
                        if(response.obj !== null){
                            for(var i = 0; i<response.obj.length;i++){
                                response.rowCounter += 1;
                                if(response.obj[i].aid != null){
                                    response.actorsString += '<tbody><tr><th scope="row">'+response.rowCounter+'</th><td><a href="showActorInfo.php?aid='+response.obj[i].aid+'">'+response.obj[i].actorfirst +' ' + response.obj[i].actorlast+'</td><td>'+response.obj[i].role +'</td></tr></tbody>'

                                }
                            }
                        }
                    } else{
                        alert('There was a problem with the request.');
                    }

                    document.getElementById('title').innerHTML = response.obj[0].title;
                    document.getElementById('year').innerHTML = response.obj[0].year;
                    document.getElementById('rating').innerHTML = response.obj[0].rating;
                    document.getElementById('company').innerHTML = response.obj[0].company;
                    document.getElementById('director').innerHTML = response.obj[0].director;
                    document.getElementById('genre').innerHTML = response.obj[0].genre;
                    document.getElementById('actors').innerHTML = response.actorsString;

                }
            }

            httpRequest.open('GET', 'handler/searchMovieByIdHandler.php?mid='+request.mid,true);
            httpRequest.send();

        }

        function GetMovieReviews() {
            var httpRequest1 = new XMLHttpRequest();

            if (!httpRequest1) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest1.onreadystatechange = function () {
                response.reviewsString = '<thead><tr><th>#</th><th>Reviewer Name</th><th>Rating</th><th>Time</th><th>Comment</th></tr></thead>';
                response.obj = "";
                response.rowCounter = 0;
                if (httpRequest1.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest1.status === 200) {
                        response.obj = JSON.parse(httpRequest1.responseText);
                        if (response.obj !== null) {
                            response.averageRating = response.obj[0].averagerating;
                            for (var i = 0; i < response.obj.length; i++) {
                                response.rowCounter += 1;
                                response.reviewsString += '<tbody><tr><th scope="row">' + response.rowCounter + '</th><td>' + response.obj[i].name + '</td><td>' + response.obj[i].rating + '</td><td>' + response.obj[i].time + '</td><td>' + response.obj[i].comment + '</td></tr></tbody>'
                            }
                        }
                    } else {
                        alert('There was a problem with the request.');
                    }

                    document.getElementById('reviews').innerHTML = response.reviewsString;
                    document.getElementById('average').innerHTML = response.averageRating;
                }
            }

            httpRequest1.open('GET', 'handler/searchReviewHandler.php?mid='+request.mid,true);
            httpRequest1.send();

        }

        function InsertMovieReviews(){
            request.reviewer = document.getElementById('reviewer').value;
            request.rating = document.getElementById('rating').value;
            request.comment = document.getElementById('comment').value;

            if(document.getElementById('rRadio1').checked){
                request.rating = document.getElementById('rRadio1').value;
            }
            else if(document.getElementById('rRadio2').checked){
                request.rating = document.getElementById('rRadio2').value;
            }
            else if(document.getElementById('rRadio3').checked){
                request.rating = document.getElementById('rRadio3').value;
            }
            else if(document.getElementById('rRadio4').checked){
                request.rating = document.getElementById('rRadio4').value;
            }
            else if(document.getElementById('rRadio5').checked) {
                request.rating = document.getElementById('rRadio5').value;
            }


            var httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = function () {
                if (httpRequest.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest.status === 200) {
                        document.getElementById('response').innerHTML = httpRequest.responseText;
                        GetMovieReviews();
                    } else {
                        alert('There was a problem with the request.');
                    }
                }
            }

            httpRequest.open('GET', 'handler/AddMovieReviewHandler.php?mid='+encodeURI(request.mid)+'&name='+encodeURI(request.reviewer)+'&rating='+encodeURI(request.rating)+'&comment='+encodeURI(request.comment),true);
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




