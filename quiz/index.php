<?php
require_once('../api/src/db.php'); //db connection
require_once('../api/src/Quiz.php'); //Quiz class

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   if (!empty($_GET['code'])) {
       $id = Quiz::findQuizeIdbyCode($conn, $_GET['code']);
       $quiz = Quiz::loadQuizById($conn, $id);
       var_dump($quiz);
   }
}

