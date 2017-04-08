<?php
$id = Quiz::findQuizeIdbyCode($conn, $_GET['code']);
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
<!DOCTYPE html>
<html lang="en">
    <!--HEADER-->
    <?php require_once(__DIR__.'/html/header.html'); ?>
    <!--/HEADER-->
    <body>
        <!--NAVBAR-->
        <?php require_once(__DIR__. '/navbar.php') ?>
        <!--/NAVBAR-->

        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6 ">
                    <h2><?php echoHtml($quiz->getName()) ?></h2>
                    <h3><?php echoHtml($quiz->getDescription()) ?> </h3>
                    <form method="POST" action="api/quizRezult.php" role="form" id="form">
                        <?php
                        //FOREACH QUESTION
                        foreach ($questions as $ind => $quest) {
                        ?>
                            <div class="question">
                                <fieldset>
                                <hr>
                                <h5>Question <?php echoHtml($ind) ?></h5>
                                <h4><?php echoHtml($quest) ?></h4>
                                <?php
                                foreach ($answers[$ind] as $anNb => $val) {
                                ?>
                                <label class="radio"><input type="radio" name="answer<?php echoHtml($ind) ?>" value="<?php echoHtml($anNb) ?>"><?= echoHtml($val) ?></label>
                                <?php
                                }
                                ?>
                                </fieldset>
                            </div>
                        <?php
                        }
                        ?>
                        <hr>
                        <button type="submit" class="btn btn-success" id="sendQuiz">Send</button>
                    </form>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <!--FOOTER-->
        <?php require_once(__DIR__.'/html/footer.html'); ?>
        <!--/FOOTER-->
    </body>
</html>