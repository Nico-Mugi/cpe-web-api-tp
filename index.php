<?php
    include 'Models/DatabaseDriver.php';
    $dbd = new DatabaseDriver;
    $keywordChosen = "aisselle";
    $pathos = $dbd->getAllPatho();
    foreach($pathos as $patho){
        echo('<div class="pathologie_card">');
        echo('<h3>'.ucfirst($patho->__get("desc")).'</h3>');
        echo('<p class="meridien">Méridien : '.$patho->__get("mer")->__get("nom").'</p>');
        echo('<p class="symptomes_title">Symptômes<span class="chevron down" onclick="showSymptomes(this)"></span></p>');
        echo('<ul class="sympthomes_container">');
        $i = 0;
        foreach($patho->__get("symptomes") as $symp){
            echo('<li>'.$symp->__get("desc").'</li>');
            if($i < count($patho->__get("symptomes")) - 1) echo('<hr>');
            $i ++;
        }
        echo('</ul>');
        echo('</div>');
    }
?>    