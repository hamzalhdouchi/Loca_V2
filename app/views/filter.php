<?php

require "../controller/VehiculeController.php";


    $class = new Vehicule();
    
    $resultee = $class->afficherVoitureCategorie();
    
    var_dump(json_encode($resultee));
