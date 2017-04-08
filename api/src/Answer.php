<?php

class Answer implements JsonSerializable {
    
    private $id;
    private $quiz_id;
    private $replies;

    
    public function __construct() {
        $this->id = -1;
        $this->quiz_id = -1;
        $this->replies = [];
      
    }
    
    public function create(PDO $conn) {
        $stmt = $conn->prepare('INSERT INTO answers SET quiz_id=:quiz_id, replies=:replies');
        $stmt->execute([ 
            'quiz_id' => $this->getQuiz_id(),
            'replies' => json_encode($this->replies),
           
        ]);
        $insertedId = $conn->lastInsertId();
        if ($insertedId > 0) {
            $this->id = $insertedId;
            return $this;
        } else {
            return null;
        }
    }
    
    public static function loadAnswerById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM answers WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            $answer = new Answer();
            $answer->id = $row['id'];
            $answer->quiz_id = $row['quiz_id'];
            $answer->replies = json_decode($row['replies']);
            
            return $answer;
        } else {
            return null;
        }
    }
    
    public static function loadAnswerByQuizId(PDO $conn, $quiz_id){
        $stmt = $conn->prepare('SELECT * FROM answers WHERE quiz_id=:quiz_id');
        $result = $stmt->execute(['quiz_id' => $quiz_id]);
        
        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $answer = new Answer();
            $answer->id = $row['id'];
            $answer->quiz_id = $row['quiz_id'];
            $answer->replies = json_decode($row['replies']);
            
            return $answer;
        } else {
            return null;
        }
    }
    

    public function jsonSerialize() {
        
    }
    
    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getQuiz_id() {
        return $this->quiz_id;
    }

    public function getReplies() {
        return $this->replies;
    }

    public function setQuiz_id($quiz_id) {
        $this->quiz_id = $quiz_id;
    }

    public function setReplies($replies) {
        $this->replies = $replies;
    }


}