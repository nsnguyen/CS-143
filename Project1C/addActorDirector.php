
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Actor or Director</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
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
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter">
        <h1>This is where you can add a new Actor or Director.</h1>
        <h4>Please enter First and Last name, gender, date of birth, and date of death if available.</h4>
    </div>
    <form class="form-horizontal">
        <div class="form-group">
            <div class="radio col-sm-3 text-right">
                <label>
                    <input type="radio" name="ActorDirectorRadios" id="aRadio1" value="actor" checked>
                    Actor
                </label>
            </div>
            <div class="radio col-sm-3 text-left">
                <label>
                    <input type="radio" name="ActorDirectorRadios" id="aRadio2" value="director">
                    Director
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 text-right" for="firstName">First Name</label>
            <input class ="col-sm-8" type="text" class="form-control" id="first" placeholder="Enter First Name..." name="first" >
        </div>
        <div class="form-group">
            <label class = "col-sm-3 text-right" for="lastName">Last Name</label>
            <input class = "col-sm-8" type="text" class="form-control" id="last" placeholder="Enter Last Name..." name="last" >
        </div>

        <div class="form-group">
            <label class="col-sm-3 text-right">Gender</label>
            <div class="radio col-sm-1 text-right">
                <label>
                    <input type="radio" name="genderRadios" id="gRadio1" value="Male" checked>
                    Male
                </label>
            </div>
            <div class="radio col-sm-2 text-left">
                <label>
                    <input type="radio" name="genderRadios" id="gRadio2" value="Female">
                    Female
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class = "col-sm-3 text-right" for="dob">Date of Birth (YYYY-MM-DD)</label>
            <input class = "col-sm-8" type="text" class="form-control" id="dob" placeholder="Enter Date of Birth..." name="dob" >
        </div>
        <div class="form-group">
            <label class = "col-sm-3 text-right" for="dod">Date of Death (YYYY-MM-DD) </label>
            <input class = "col-sm-8" type="text" class="form-control" id="dod" placeholder="Enter Date of Death..." name ="dod">
        </div>

        <div class="form-group">
            <div class="col-sm-3"></div>
            <button type="button" id = "submit" class="btn btn-success col-sm-2" name="submit">Submit</button>
        </div>


        <div class="col-sm-12 text-center" id="response"></div>

    </form>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

    (function() {
        var httpRequest;

        document.getElementById("submit").onclick = function() { InsertActorDirector(); };

        function InsertActorDirector(){
            var first = document.getElementById('first').value;
            var last = document.getElementById('last').value;
            var dob = document.getElementById('dob').value;
            var dod = document.getElementById('dod').value;

            if(document.getElementById('gRadio1').checked){
                var gender = document.getElementById('gRadio1').value;
            }
            else if(document.getElementById('gRadio2').checked){
                var gender = document.getElementById('gRadio2').value;
            }

            if(document.getElementById('aRadio1').checked){
                var type = document.getElementById('aRadio1').value;
            }
            else if(document.getElementById('aRadio2').checked){
                var type = document.getElementById('aRadio2').value;
            }


            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('GET', 'handler/AddActorDirectorHandler.php?ActorDirectorRadios='+encodeURI(type)+'&first='+encodeURI(first)+'&last='+encodeURI(last)+'&genderRadios='+encodeURI(gender)+'&dob='+encodeURI(dob)+'&dod='+encodeURI(dod),true);
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
