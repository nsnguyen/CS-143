
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
                <li><a href="addActorMovie.php">Add Actor/Movie Relation</a></li>
                <li><a href="addDirectorMovie.php">Add Director/Movie Relation</a></li>
                <li><a href="Search.php">Search</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter">
        <h1>This is where you can add a new Movie.</h1>
        <h4>Please add Title, Year, Rating, Genre (you can add more than one genre), and Company.</h4>
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
                    <input type="radio" name="rating" id="rRadio1" value="G" checked>
                    G
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="rating" id="rRadio2" value="PG">
                    PG
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="rating" id="rRadio3" value="PG-13">
                    PG-13
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="rating" id="rRadio4" value="NC-17">
                    NC-17
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="rating" id="rRadio5" value="R">
                    R
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="rating" id="rRadio6" value="surrendere">
                    surrendere
                </label>
            </div>
            <div class="radio col-xs-1">
                <label>
                    <input type="radio" name="rating" id="rRadio7" value="others">
                    others
                </label>
            </div>
        </div>

        <div class="form-group">
<!--            <label class="col-sm-3 text-right" for="rating">Genre</label>-->
<!--            <select id="genre" name="genre" class="col-sm-8">-->
<!--                <option value="Drama">Drama</option>-->
<!--                <option value="Comedy">Comedy</option>-->
<!--                <option value="Romance">Romance</option>-->
<!--                <option value="Crime">Crime</option>-->
<!--                <option value="Horror">Horror</option>-->
<!--                <option value="Mystery">Mystery</option>-->
<!--                <option value="Thriller">Thriller</option>-->
<!--                <option value="Action">Action</option>-->
<!--                <option value="Adventure">Adventure</option>-->
<!--                <option value="Fantasy">Fantasy</option>-->
<!--                <option value="Documentary">Documentary</option>-->
<!--                <option value="Family">Family</option>-->
<!--                <option value="Sci-Fi">Sci-Fi</option>-->
<!--                <option value="Animation">Animation</option>-->
<!--                <option value="Musical">Musical</option>-->
<!--                <option value="War">War</option>-->
<!--                <option value="Western">Western</option>-->
<!--                <option value="Adult">Adult</option>-->
<!--                <option value="Short">Short</option>-->
<!--                <option value="Others">Others</option>-->
<!--            </select>-->

            <div class="form-group">
                <label class="col-sm-3 text-right" for="genre">Genre</label>
                <input type="checkbox" name="genre" id="Drama" value="Drama">  Drama
                <input type="checkbox" name="genre" id="Comedy" value="Comedy">  Comedy
                <input type="checkbox" name="genre" id="Romance" value="Romance">  Romance
                <input type="checkbox" name="genre" id="Horror" value="Horror">  Horror
                <input type="checkbox" name="genre" id="Mystery" value="Mystery">  Mystery
                <input type="checkbox" name="genre" id="Thriller" value="Thriller">  Thriller
                <input type="checkbox" name="genre" id="Action" value="Action">  Action
                <input type="checkbox" name="genre" id="Adventure" value="Adventure">  Adventure
                <input type="checkbox" name="genre" id="Fantasy" value="Fantasy">  Fantasy
                <input type="checkbox" name="genre" id="Documentary" value="Documentary">  Documentary
                <input type="checkbox" name="genre" id="Family" value="Family">  Family
                <input type="checkbox" name="genre" id="Sci-Fi" value="Sci-Fi">  Sci-Fi
                <input type="checkbox" name="genre" id="Animation" value="Animation">  Animation
                <input type="checkbox" name="genre" id="Musical" value="Musical">  Musical
                <input type="checkbox" name="genre" id="War" value="War">  War
                <input type="checkbox" name="genre" id="Western" value="Western">  Western
                <input type="checkbox" name="genre" id="Adult" value="Adult">  Adult
                <input type="checkbox" name="genre" id="Short" value="Short">  Short
                <input type="checkbox" name="genre" id="Others" value="Others">  Others


            </div>

        </div>




        <div class="form-group">
            <div class="col-sm-3"></div>
            <button type="button" id = "submit" class="btn btn-success col-sm-2" name="submit">Submit</button>
        </div>


        <div class="col-sm-12 text-center" id="response"></div>

    </form>

</div>


<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    (function() {
        var httpRequest;
        var request = {
            title:"",
            year:"",
            company:"",
            rating:"",
            genre:""

        }

        document.getElementById("submit").onclick = function() { InsertMovie(); };

        function InsertMovie(){

            request.title = document.getElementById('title').value;
            request.year = document.getElementById('year').value;
            request.company = document.getElementById('company').value;


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
            else if(document.getElementById('rRadio6').checked){
                request.rating = document.getElementById('rRadio6').value;
            }
            else if(document.getElementById('rRadio7').checked){
                request.rating = document.getElementById('rRadio7').value;
            }


            var genres = [];

            if(document.getElementById('Drama').checked === true){
                genres.push(document.getElementById('Drama').value);
            }
            if(document.getElementById('Comedy').checked === true){
                genres.push(document.getElementById('Comedy').value);
            }
            if(document.getElementById('Romance').checked === true){
                genres.push(document.getElementById('Romance').value);
            }
            if(document.getElementById('Horror').checked === true) {
                genres.push(document.getElementById('Horror').value);
            }
            if(document.getElementById('Mystery').checked === true){
                genres.push(document.getElementById('Mystery').value);
            }
            if(document.getElementById('Thriller').checked === true){
                genres.push(document.getElementById('Thriller').value);
            }
            if(document.getElementById('Action').checked === true){
                genres.push(document.getElementById('Action').value);
            }
            if(document.getElementById('Adventure').checked === true){
                genres.push(document.getElementById('Adventure').value);
            }
            if(document.getElementById('Fantasy').checked === true){
                genres.push(document.getElementById('Fantasy').value);
            }
            if(document.getElementById('Documentary').checked === true){
                genres.push(document.getElementById('Documentary').value);
            }
            if(document.getElementById('Family').checked === true){
                genres.push(document.getElementById('Family').value);
            }
            if(document.getElementById('Sci-Fi').checked === true){
                genres.push(document.getElementById('Sci-Fi').value);
            }
            if(document.getElementById('Animation').checked === true){
                genres.push(document.getElementById('Animation').value);
            }
            if(document.getElementById('Musical').checked === true){
                genres.push(document.getElementById('Musical').value);
            }
            if(document.getElementById('War').checked === true){
                genres.push(document.getElementById('War').value);
            }
            if(document.getElementById('Western').checked === true){
                genres.push(document.getElementById('Western').value);
            }
            if(document.getElementById('Adult').checked === true){
                genres.push(document.getElementById('Adult').value);
            }
            if(document.getElementById('Short').checked === true){
                genres.push(document.getElementById('Short').value);
            }
            if(document.getElementById('Others').checked === true){
                genres.push(document.getElementById('Others').value);
            }

            request.genre= genres.join(",");

            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('GET', 'handler/AddMovieHandler.php?title='+encodeURI(request.title)+'&year='+encodeURI(request.year)+'&company='+encodeURI(request.company)+'&rating='+encodeURI(request.rating)+'&genre='+encodeURI(request.genre),true);
            httpRequest.send();

        }

        function alertContents() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    //alert(httpRequest.responseText);
                    document.getElementById('response').innerHTML = httpRequest.responseText;
                } else {
                    alert('There was a problem with the request.');
                }
            }
        }
    })();



</script>

</body>
</html>


