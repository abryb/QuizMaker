<?php

class Quiz implements JsonSerializable {
    
    private $id;
    private $name;
    private $code;
    private $description;
    private $questions;
    private $answers;
    private $correct;
    
    
    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->description = '';
        $this->questions = [];
        $this->answers = [];
        $this->correct = [];        
    }
    
    public function create(PDO $conn) {
        $stmt = $conn->prepare('INSERT INTO quizes SET name=:name, dsc=:dsc, code=:code, questions=:questions, answers=:answers, correct=:correct');
        $stmt->execute([ 
            'name' => $this->getName(),
            'dsc' => $this->getDescription(),
            'code' => $this->getCode(),
            'questions' => json_encode($this->getQuestions()),
            'answers' => json_encode($this->getAnswers()),
            'correct' => json_encode($this->getCorrect())            
        ]);
        $insertedId = $conn->lastInsertId();
        if ($insertedId > 0) {
            $this->id = $insertedId;
            return $this;
        } else {
            return null;
        }
    }
    
    public static function loadQuizById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM quizes WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            $quiz = new Quiz();
            $quiz->id = $row['id'];
            $quiz->name = $row['name'];
            $quiz->code = $row['code'];
            $quiz->description = $row['dsc'];
            $quiz->questions = json_decode($row['questions']);
            $quiz->answers = json_decode($row['answers']);
            $quiz->correct = json_decode($row['correct']);
            
            return $quiz;
        } else {
            return null;
        }
    }
    
    public static function findQuizeIdbyCode(PDO $conn, $code) {
        $stmt = $conn->prepare('SELECT id FROM quizes WHERE code=:code');
        $result = $stmt->execute(['code' => $code]);
        
        if ($result && $stmt->rowCount() > 0) {
            $idSql = $stmt->fetch();
            return $idSql['id'];
        } else {
            return -1;
        }
        
    }

    public function jsonSerialize() {
        
    }
    
    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function getAnswers() {
        return $this->answers;
    }

    public function getCorrect() {
        return $this->correct;
    }
    
    public function getCode() {
        return $this->code;
    }

    public function setCode() {
        $this->code = substr(md5(mt_rand()), mt_rand(0, 22), 8);
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setQuestions($questions) {
        $this->questions = $questions;
    }

    public function setAnswers($answers) {
        $this->answers = $answers;
    }

    public function setCorrect($correct) {
        $this->correct = $correct;
    }   
}