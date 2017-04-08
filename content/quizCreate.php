
<script src="js/quiz.js"></script>

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
