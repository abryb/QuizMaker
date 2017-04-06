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

    public function jsonSerialize() {
        echo "fdsf";
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
        $this->code = substr(md5(mt_rand()),0, 8);
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