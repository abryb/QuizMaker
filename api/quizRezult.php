<?php

require_once(__DIR__ . '/src/db.php'); //db connection
require_once(__DIR__ . '/src/Quiz.php'); //Quiz class
require_once(__DIR__ . '/src/Solution.php'); //Quiz class
//geting quiz code from http referer
$code = substr($_SERVER['HTTP_REFERER'], -8);

//setting array of answers
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST)) {
        $replies = [];
        foreach ($_POST as $question => $answer) {
            $replies[] = $answer;
        }
    }
}
//loading quiz id from code
$quizId = Quiz::findQuizeIdbyCode($conn, $code);

//creating new answer obcjet, to save to db
if ($quizId > 0) {
    $solution = new Solution();
    $solution->setQuizId($quizId);
    $solution->setReplies($replies);
    $insertedSolution = $solution->create($conn);
    $insertedId = $insertedSolution->getId();
}
//redirect to index with get to show quiz with user solution
header("Refresh: 0; url=../index.php?code=$code&solution=$insertedId");

