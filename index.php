<?php

require_once(__DIR__ . '/api/src/db.php'); //db connection
require_once(__DIR__ . '/api/src/Quiz.php'); //Quiz class
require_once(__DIR__ . '/api/src/Answer.php'); //Quiz class


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['code']) && !empty($_GET['answer'])) {
        require_once(__DIR__ . '/content/repliesShow.php');
    } elseif (!empty($_GET['code']) && empty($_GET['answer'])) {
        require_once(__DIR__ . '/content/quizShow.php');
    } else {
        require_once(__DIR__ . '/content/quizCreate.php');
    }
}
