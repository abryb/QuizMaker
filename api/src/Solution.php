<?php

class Solution implements JsonSerializable {
    
    private $id;
    private $quizId;
    private $replies;

    
    public function __construct() {
        $this->id = -1;
        $this->quizId = -1;
        $this->replies = [];
      
    }
    
    public function create(PDO $conn) {
        $stmt = $conn->prepare('INSERT INTO solutions SET quizId=:quizId, replies=:replies');
        $stmt->execute([ 
            'quizId' => $this->getQuizId(),
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
    
    public static function loadSolutionById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM solutions WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result && $stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            $solution = new Solution();
            $solution->id = $row['id'];
            $solution->quizId = $row['quizId'];
            $solution->replies = json_decode($row['replies']);
            
            return $solution;
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

    public function getQuizId() {
        return $this->quizId;
    }

    public function getReplies() {
        return $this->replies;
    }

    public function setQuizId($quizId) {
        $this->quizId = $quizId;
    }

    public function setReplies($replies) {
        $this->replies = $replies;
    }


}