<?php
require_once(__DIR__ . '/src/db.php'); //db connection
require_once(__DIR__ . '/src/Quiz.php'); //Quiz class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $quizObj = new Quiz();
    $quizObj->setName($_POST['name']);
    $quizObj->setDescription($_POST['descr']);
    $quizObj->setQuestions($_POST['questions']);
    $quizObj->setAnswers($_POST['answers']);
    $quizObj->setCorrect($_POST['correct']);
    $quizObj->setCode();
    $result = $quizObj->create($conn);
    if ($result) {
        echo json_encode($quizObj->getCode());
    }
}
