<?php

require_once(__DIR__ . '/api/src/db.php'); //db connection
require_once(__DIR__ . '/api/src/Quiz.php'); //Quiz class
require_once(__DIR__ . '/api/src/Solution.php'); //Quiz class


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['code']) && !empty($_GET['solution'])) {
        $content = __DIR__ . '/content/repliesShow.php';
        
    } elseif (!empty($_GET['code']) && empty($_GET['solution'])) {
        $content = __DIR__ . '/content/quizShow.php';
        
    } else {
        $content = __DIR__ . '/content/quizCreate.php';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <!--HEADER-->
    <?php require_once(__DIR__.'/content/html/header.html'); ?>
    <!--/HEADER-->
    <body>
        <!--NAVBAR-->
        <?php require_once(__DIR__.'/content/navbar.php') ?>
        <!--/NAVBAR-->
        <!--CONTENT-->
        <?php require_once($content) ?>
        <!--/CONTENT-->
        <!--FOOTER-->
        <?php require_once(__DIR__.'/content/html/footer.html'); ?>
        <!--/FOOTER-->
    </body>
</html>