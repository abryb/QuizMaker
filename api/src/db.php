<?php

define('DB_LOGIN', 'root'); //login
define('DB_PASS', 'coderslab'); //password
define('DB_DB', 'quizMaker'); //database
define('DB_HOST', 'localhost'); //host

// connection with DB
try {
    $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DB . ';charset=utf8mb4', DB_LOGIN, DB_PASS, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo 'DB_ERROR: ' . $e->getMessage();
    exit;
}