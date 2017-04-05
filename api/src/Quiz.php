<?php

class Quiz implements JsonSerializable {
    
    private $id;
    private $name;
    private $description;
    private $quizArray;
    
    public function jsonSerialize() {
        echo "fdsf";
    }
}