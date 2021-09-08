<?php
    include './Models/DatabaseDriver.php';
    $dbd = new DatabaseDriver;
    $symptomes = $dbd->getAllSymptomes();
    foreach($symptomes as $symptome){
        echo($symptome->__get("ids"));
        echo(" :: ");
        echo($symptome->__get("desc"));
        echo("<br/>");
    }
?>