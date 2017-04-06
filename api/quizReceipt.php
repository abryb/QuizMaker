<?php

require_once(__DIR__ . '/src/db.php'); //db connection
require_once(__DIR__ . '/src/Quiz.php'); //Quiz class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//    var_dump($_POST);
    $name = $_POST['name'];
    $description = $_POST['descr'];
    $questions = $_POST['questions'];
    $answers = $_POST['answers'];
    $correct = $_POST['correct'];

    $quizObj = new Quiz();
    $quizObj->setName($name);
    $quizObj->setDescription($description);
    $quizObj->setQuestions($questions);
    $quizObj->setAnswers($answers);
    $quizObj->setCorrect($correct);
    $quizObj->setCode();
    var_dump($quizObj);
    $quizObj->create($conn);
    

//    $json = json_encode($answers);
//    $str = serialize($answers);
//    var_dump($str);
//    var_dump($json);
}
