<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = Quiz::findQuizeIdbyCode($conn, $_GET['code']);
}
if ($id > 0 ) {
    $quiz = Quiz::loadQuizById($conn, $id);
    $questions = $quiz->getQuestions();
    $answers = $quiz->getAnswers();
} else {
    exit;
}
function echoHtml($string) {
    echo htmlspecialchars($string);
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 ">
            <h2><?php echoHtml($quiz->getName()) ?></h2>
            <h3><?php echoHtml($quiz->getDescription()) ?> </h3>
            <form method="POST" action="api/quizRezult.php" role="form" id="form">
                <!--FOREACH QUESTION ADD DIV-->
                <?php foreach ($questions as $qstNmbr => $qstText) { ?>
                    <div class="question">
                        <fieldset>
                        <hr>
                        <h5>Question <?php echoHtml($qstNmbr+1) ?></h5>
                        <h4><?php echoHtml($qstText) ?></h4>
                        <!--ADD ANSWERS-->
                        <?php foreach ($answers[$qstNmbr] as $ansNmbr => $ansText) { ?>
                        <label class="radio"><input type="radio" name="answer<?php echoHtml($qstNmbr) ?>" value="<?php echoHtml($ansNmbr) ?>"><?php echoHtml($ansText) ?></label>
                        <?php } ?>
                        </fieldset>
                    </div>
                <?php } ?>
                <hr>
                <button type="submit" class="btn btn-success" id="sendQuiz">Send</button>
            </form>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>
