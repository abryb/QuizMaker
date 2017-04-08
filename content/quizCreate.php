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
                    <a class="navbar-brand" href="">QuizMaker</a>
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
                            <div>
                            <label for="name">Quiz Name: </label><span title="control"></span>
                            <input type="text" class="form-control" name="name" id="name" maxlength="140"
                                   placeholder="Quiz Name">
                            </div>
                            <div>
                            <label for="description">Description:</label><span title="control"></span>
                            <textarea class="form-control" name="description" id="description" maxlength="300"
                                      placeholder="Quiz Description"></textarea> 
                            </div>
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
        <footer class="footer" style="margin-top: 100px;">
            <div class="container">
                <span class="text-muted">Place sticky footer content here.</span>
            </div>
        </footer>

    </body>
</html>