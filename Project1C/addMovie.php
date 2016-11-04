
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Movie</title>

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
                <li><a href="search.php">Search</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter">
        <h1>This is where you can add a new Movie.</h1>
        <h4>Add Title, Year, Rating, Genre and Company.</h4>
    </div>
    <form class="form-horizontal" >
        <div class="form-group">
            <label class="col-sm-3 text-right" for="title">Title</label>
            <input class="col-sm-8" type="text" class="form-control" id="title" placeholder="Enter Title..." name = "title" required>
        </div>
        <div class="form-group">
            <label class="col-sm-3 text-right" for="year">Year</label>
            <input class="col-sm-8" type="text" class="form-control" id="year" placeholder="Enter Year..." name="year" required>
        </div>

        <div class="form-group">
            <label class="col-sm-3 text-right" for="company">Company</label>
            <input class="col-sm-8" type="text" class="form-control" id="company" placeholder="Enter Company..." name="company" required>
        </div>

        <div class="form-group">
            <label class="col-sm-3 text-right">MPAA Rating</label>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio1" value="G" checked>
                    G
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio2" value="PG">
                    PG
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio3" value="PG-13">
                    PG-13
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio4" value="NC-17">
                    NC-17
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio5" value="R">
                    R
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio6" value="surrendere">
                    surrendere
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="ratingRadios" id="rRadio7" value="others">
                    others
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 text-right" for="rating">Genre</label>
            <select id="genre" name="genre" class="col-sm-8">
                <option value="Drama">Drama</option>
                <option value="Comedy">Comedy</option>
                <option value="Romance">Romance</option>
                <option value="Crime">Crime</option>
                <option value="Horror">Horror</option>
                <option value="Mystery">Mystery</option>
                <option value="Thriller">Thriller</option>
                <option value="Action">Action</option>
                <option value="Adventure">Adventure</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Documentary">Documentary</option>
                <option value="Family">Family</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Animation">Animation</option>
                <option value="Musical">Musical</option>
                <option value="War">War</option>
                <option value="Western">Western</option>
                <option value="Adult">Adult</option>
                <option value="Short">Short</option>
                <option value="Others">Others</option>
            </select>
        </div>


        <button type="submit" id = "submit" class="btn btn-success" name="submit" onclick="InsertMovie()">Submit</button>

        <div id="response"></div>

    </form>

</div>


<script src="js/jquery-3.1.1.min.js"></script>
<!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
<script src="js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>

<script>
    function InsertMovie(){
        var title = document.getElementById('title').value;
        var year = document.getElementById('year').value;
        var company = document.getElementById('company').value;

        if(document.getElementById('rRadio1').checked){
            var rating = document.getElementById('rRadio1').value;
        }
        else if(document.getElementById('rRadio2').checked){
            var rating = document.getElementById('rRadio2').value;
        }
        else if(document.getElementById('rRadio3').checked){
            var rating = document.getElementById('rRadio3').value;
        }
        else if(document.getElementById('rRadio4').checked){
            var rating = document.getElementById('rRadio4').value;
        }
        else if(document.getElementById('rRadio5').checked){
            var rating = document.getElementById('rRadio5').value;
        }
        else if(document.getElementById('rRadio6').checked){
            var rating = document.getElementById('rRadio6').value;
        }
        else if(document.getElementById('rRadio7').checked){
            var rating = document.getElementById('rRadio7').value;
        }

        var genre = document.getElementById('genre').value;


        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('response').innerHTML = this.responseText;
            }
        }
        request.open("GET","handler/AddMovieHandler.php?title="+title+"&year="+year+"&company="+company+"&ratingRadios="+rating+"&genre="+genre);
        request.send();
    }

</script>
<?php include ("handler/AddMovieHandler.php"); ?>


</body>
</html>


