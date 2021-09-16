<?php
    include 'Models/DatabaseDriver.php';
    $dbd = new DatabaseDriver;
    $pathos = $dbd->getPathoByKeyWord("aisselle");
    foreach($pathos as $patho){
        echo($patho->__get("idp"));
        echo(" :: ");
        echo($patho->__get("mer"));
        echo(" :: ");
        echo($patho->__get("type"));
        echo(" :: ");
        echo($patho->__get("desc"));
        echo("<br/>");
    }
?>
