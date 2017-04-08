<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['code']) && !empty($_GET['solution'])){
        //load quiz id
        $quizId = Quiz::findQuizeIdbyCode($conn, $_GET['code']);
        //create answer obcjet
        $solution = Solution::loadSolutionById($conn, $_GET['solution']);
    }
}
if ($quizId < 0 || $solution == null) {
    sleep(2);
    header("Refresh:0");
} else {

    //create quiz object and load questions, answers and correct 
    $quiz = Quiz::loadQuizById($conn, $quizId);
    $questions = $quiz->getQuestions();
    $answers = $quiz->getAnswers();
    $correct = $quiz->getCorrect();
    //load user replies
    $replies = $solution->getReplies();

    $questionCount = count($questions);
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
<!--COLORING SCRIPT-->
    <script>
        $(function () {
    <?php foreach ($replies as $qst => $rpl) { ?>
                //foreach replie find label and set color to red
                var userChoice = $('div[data-questionId="<?php echoHtml($qst) ?>"]').find('input[value="<?php echoHtml($rpl) ?>"]');
                userChoice.parent().css({'color': 'red', 'text-decoration': 'underline'});
                userChoice.prop('checked', true);
    <?php } ?>
    <?php //foreach question find correct answers and style color for green
        foreach ($correct as $ind => $val) {
            foreach ($val as $anInd => $cor) {
                if ($cor == 'true') {
    ?>
                    $('div[data-questionId="<?php echoHtml($ind) ?>"]').find('input[value="<?php echoHtml($anInd) ?>"]').parent().css('color', 'green');

    <?php }}} ?>
        });
    </script>
    <!--/COLORING SCRIPT-->
  
<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 ">
            <h1>Your score is <?php echoHtml($points) . echoHtml("/".$questionCount) ?></h1>
            <h2><?php echoHtml($quiz->getName()) ?></h2>
            <h3><?php echoHtml($quiz->getDescription()) ?> </h3>
            <!--FOREACH QUESTION ADD DIV-->
            <?php foreach ($questions as $qstNmbr => $qstText) { ?>
            <div class="question" data-questionId="<?php echoHtml($ind) ?>">
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
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>
        