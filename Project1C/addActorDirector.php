
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS143 Movie Database</title>

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
            <div class="radio col-sm-2">
                <label>
                    <input type="radio" name="ActorDirectorRadios" id="aRadio1" value="actor" checked>
                    Actor
                </label>
            </div>
            <div class="radio col-sm-2">
                <label>
                    <input type="radio" name="ActorDirectorRadios" id="aRadio2" value="director">
                    Director
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2" for="firstName">First Name</label>
            <input class ="col-sm-8" type="text" class="form-control" id="firstName" placeholder="Enter First Name..." required>
        </div>
        <div class="form-group">
            <label class = "col-sm-2" for="lastName">Last Name</label>
            <input class = "col-sm-8" type="text" class="form-control" id="lastName" placeholder="Enter Last Name..." required>
        </div>

        <div class="form-group">
            <label class="col-sm-2">Gender</label>
            <div class="radio col-sm-2">
                <label>
                    <input type="radio" name="genderRadios" id="gRadio1" value="Male" checked>
                    Male
                </label>
            </div>
            <div class="radio col-sm-2">
                <label>
                    <input type="radio" name="genderRadios" id="gRadio2" value="Female">
                    Female
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class = "col-sm-2" for="dob">Date of Birth</label>
            <input class = "col-sm-8" type="text" class="form-control" id="dob" placeholder="Enter Date of Birth..." required>
        </div>
        <div class="form-group">
            <label class = "col-sm-2" for="dod">Date of Death</label>
            <input class = "col-sm-8" type="text" class="form-control" id="dod" placeholder="Enter Date of Death...">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

    </form>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.1.1.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>

</body>
</html>
