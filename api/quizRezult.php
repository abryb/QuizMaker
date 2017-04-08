<?php
require_once(__DIR__ . '/src/db.php'); //db connection
require_once(__DIR__ . '/src/Quiz.php'); //Quiz class
require_once(__DIR__ . '/src/Answer.php'); //Quiz class

//geting quiz code from http referer
$code = substr($_SERVER['HTTP_REFERER'], -8);

//setting array of answers
$replies = [];
foreach($_POST as $question => $answer) {
    $replies[] = $answer;
}
//loading quiz id from code
$quiz_id = Quiz::findQuizeIdbyCode($conn, $code);

//creating new answer obcjet, to save to db
$clientAnswers = new Answer();
$clientAnswers ->setQuiz_id($quiz_id);
$clientAnswers->setReplies($replies);
$insertedAnswer = $clientAnswers->create($conn);
$insertedId = $insertedAnswer->getId();

//redirect to index with get to show quiz with user replies
header("Refresh: 0; url=../index.php?code=$code&answer=$insertedId");
