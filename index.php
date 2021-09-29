<?php
    include 'Models/DatabaseDriver.php';
    $dbd = new DatabaseDriver;
    $keywordChosen = "aisselle";
    echo("Mot-clé : ".$keywordChosen."<br/>");
    $pathosKeyed = $dbd->getPathosByKeyWord($keywordChosen);
    foreach($pathosKeyed as $patho){
        echo($patho->__get("desc"));
        echo(" :: ");
        echo($patho->__get("mer")->__get("nom"));
        foreach($patho->__get("symptomes") as $symp){
            echo("<br/>");
            echo($symp->__get("desc"));
        }
        echo("<br/>");
        echo("<br/>");
        echo("<br/>");
    }
    echo("-------------------------------------------------------------");
    $pathos = $dbd->getAllPatho();
    foreach($pathos as $patho){
        echo($patho->__get("desc"));
        echo(" :: ");
        echo($patho->__get("mer")->__get("nom"));
        foreach($patho->__get("symptomes") as $symp){
            echo("<br/>");
            echo($symp->__get("desc"));
        }
        echo("<br/>");
        echo("<br/>");
        echo("<br/>");
    }
?>
