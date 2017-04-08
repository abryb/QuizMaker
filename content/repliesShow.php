<?php
//load quiz id
$quiz_id = Quiz::findQuizeIdbyCode($conn, $_GET['code']);
//create answer obcjet
$answer = Answer::loadAnswerById($conn, $_GET['answer']);

if ($quiz_id < 0 || $answer == null) {
    sleep(2);
    header("Refresh:0 , url=".$_SERVER['HTTP_REFERER']);
} else {

    //create quiz obcjet and load questions, answers and correct 
    $quiz = Quiz::loadQuizById($conn, $quiz_id);
    $questions = $quiz->getQuestions();
    $answers = $quiz->getAnswers();
    $correct = $quiz->getCorrect();
    //load user replies
    $replies = $answer->getReplies();

    $questionCount = count($correct);
    $points = 0;
    foreach ($replies as $qst => $ans) {
        if ($correct[$qst][$ans] == 'true') {
            $points ++;
        }
    }
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
        <?php require_once(__DIR__.'/navbar.php') ?>
        <!--/NAVBAR-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6 ">
                    <h1>Your score is <?php echoHtml($points) . "/" . echoHtml($questionCount) ?></h1>
                    <h2><?php echoHtml($quiz->getName()) ?></h2>
                    <h3><?php echoHtml($quiz->getDescription()) ?> </h3>

                    <?php
                    //FOREACH QUESTION
                    foreach ($questions as $ind => $quest) {
                        ?>
                    <div class="question" data-questionId="<?php echoHtml($ind) ?>">
                            <fieldset>
                                <hr>
                                <h5>Question <?php echoHtml($ind) ?></h5>
                                <h4><?php echoHtml($quest) ?></h4>
                                <?php
                                foreach ($answers[$ind] as $anNb => $val) {
                                    ?>
                                <label class="radio"><input type="radio" name="answer<?php echoHtml($ind) ?>" value="<?php echoHtml($anNb) ?>"><?php echoHtml($val) ?></label>
                                    <?php
                                }
                                ?>
                            </fieldset>
                        </div>
                        <?php
                    }
                    ?>
                    <hr>

                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <!--FOOTER-->
        <?php require_once(__DIR__.'/html/footer.html'); ?>
        <!--/FOOTER-->
        <!--COLORING SCRIPT-->
        <script>
            //Script coloring answers
            $(function () {
        <?php foreach ($replies as $qst => $rpl) { ?>
                    //foreach replie find label and set color to red
                    var userChoice = $('div[data-questionId="<?php echoHtml($qst) ?>"]').find('input[value="<?php echoHtml($rpl) ?>"]');
                    userChoice.parent().css({'color': 'red', 'text-decoration': 'underline'});
                    userChoice.prop('checked', true);
        <?php } ?>
        <?php
            //foreach question find correct answers and style color for green
            foreach ($correct as $ind => $val) {
                foreach ($val as $anInd => $cor) {
                    if ($cor == 'true') {
        ?>
                        $('div[data-questionId="<?php echoHtml($ind) ?>"]').find('input[value="<?php echoHtml($anInd) ?>"]').parent().css('color', 'green');

        <?php }}} ?>
            });
        </script>
        <!--/COLORING SCRIPT-->
    </body>
</html>