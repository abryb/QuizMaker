<?php
require_once('../api/src/db.php'); //db connection
require_once('../api/src/Quiz.php'); //Quiz class

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   if (!empty($_GET['code'])) {
       $id = Quiz::findQuizeIdbyCode($conn, $_GET['code']);
       $quiz = Quiz::loadQuizById($conn, $id);
       var_dump($quiz);
   }
} else {
    header("Refresh: 0; url= ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuizMaker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>


        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">                   
                    </button>
                    <a class="navbar-brand" href="#">QuizMaker</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="quiz/">Quizes</a></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6 ">
                    <h2><?php echo $quiz->getName() ?></h2>
                    <h3><?php echo $quiz->getDescription()?> </h3>
                    <form method="POST" action="#" role="form" id="form">
                        <div class="form-control">
                            
                        </div>
                    </form>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>

    </body>
</html>