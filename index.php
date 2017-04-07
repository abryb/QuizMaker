<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuizMaker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/quiz.js"></script>
        <link href="css/style.css" type="text/css" rel="stylesheet"/>
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
                    <!--FORM-->
                    <form action="api/quizReceipt.php" method="post" role="form" id="form">
                        <div class="form-group">
                            <label for="name">Quiz Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Quiz Name">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description"
                                      placeholder="Quiz Description"></textarea>               
                        </div>
                        <hr>
                        <div id="questions">
                        </div>
                        <button type="submit" class="btn" id="addQuest">Add question</button>   
                        <hr>
                        <hr>
                        <button type="submit" class="btn btn-success" id="submit">Create Quiz</button>
                    </form>  
                    <!--FORM END-->

                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>

    </body>
</html>
