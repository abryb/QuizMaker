<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $name = '';
    $description = '';
    $questionArray = [];
    $corretArray= [];
    
    
    foreach ($_POST as $key => $val) {
        
        switch (true) {
            case ($key ==='name'):
                $name = $val;
                break;
            case ($key === 'description'):
                $description = $val;
                break;
            case (strstr($key, 'question')):
                echo "DZIAŁA";
                $questionArray[$val] = [];
                break;
            case (strstr($key, 'ans')):
                $questionArray[] = '';
                break;
            case (strstr($key, 'corr')):
                break;
            default:
                break;
        }
        
    }
}
