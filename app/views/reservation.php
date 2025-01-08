<?php
session_start();

if (!$_SESSION) {
    header('Location: ./register.php');
exit();
}
require __DIR__."/../controller/AvisController.php";
require __DIR__."/../controller/ReservationController.php";

$avis = new avis();

$raiting = $avis->getavis();
$reserv= new reservation();
$id =  $_SESSION['user_id'];
$reservation = $reserv->getReservationUSER($id);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
       <!-- Navigation -->
       <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-car-side text-2xl text-blue-600 mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">AutoLoc</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="./inde.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-home mr-1"></i> Accueil
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </a>
                    <a href="./reservation.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bookmark mr-1"></i> Réservations
                    </a>
                    <a href="./register.php"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        <i class="fas fa-sign-in-alt mr-1"></i> Connexion
</a>
                </div>
            </div>
        </div>
    </nav> 
<div class="bg-gray-100 min-h-screen relative top-20">
    <div class="max-w-[100vw] mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Mes Réservations</h1>

        <!-- Reservation Table -->
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b pb-2 text-gray-700 font-medium">Véhicule</th>
                    <th class="border-b pb-2 text-gray-700 font-medium">Date de réservation</th>
                    <th class="border-b pb-2 text-gray-700 font-medium">Prix</th>
                    <th class="border-b pb-2 text-gray-700 font-medium">Avis</th>
                    <th class="border-b pb-2 text-gray-700 font-medium">Statut</th>
                    <th class="border-b pb-2 text-gray-700 font-medium">Action</th>
                </tr>
            </thead>
           
            <tbody>
            <?php
            foreach($reservation as $row):

                $idA = $row['vehicule_id'];
                $result = $avis->getAVG($idA);

                
            ?>
                <!-- Example Reservation -->
                <tr class="hover:bg-gray-50">
                    <td class="py-3 text-gray-800"><?= htmlspecialchars($row['modele']) ?></td>
                    <td class="py-3 text-gray-600"><?= htmlspecialchars($row['date_reservation']) ?></td>
                    <td class="py-3 text-gray-800"><?= htmlspecialchars($row['prix']) ?>DH</td>
                    <td class="py-3">
                        <td>
                            <?php 
                            if ($result == 1) {
                                ?>
                                <i class="fas fa-star text-yellow-400">⭐</i>
                                <?php
                            }elseif($result == 2){
                                ?>
                                <i class="fas fa-star text-yellow-400">⭐⭐</i>
                                <?php
                            }elseif($result == 3){
                                ?>
                                <i class="fas fa-star text-yellow-400">⭐⭐⭐</i>
                                <?php
                            }elseif($result == 4){
                                ?>
                                <i class="fas fa-star text-yellow-400">⭐⭐⭐⭐</i>
                                <?php
                            }elseif($result == 5){
                                ?>
                                <i class="fas fa-star text-yellow-400">⭐⭐⭐⭐⭐</i>
                                <?php
                            }
                            ?>
                        </td>
                    <td>
                        <?php 
                        if ($row['status'] == 0) {
                            ?>
                             <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-sm">confirmer</span>
                            <?php
                        }elseif ($row['status'] == 1) {
                            ?>
                            <span class="bg-green-100 text-red-700 px-2 py-1 rounded-full text-sm">refeser</span>
                           <?php
                        }elseif($row['status'] == 2) {
                            ?>
                            <span class="bg-green-100 text-gray-700 px-2 py-1 rounded-full text-sm">en attent</span>
                           <?php
                        }
                        ?>
                       
                    </td>
                  
                    <td class="py-3">
                        <?php 
                        if ($result == null) {
                        ?>
                        <form action="./formreservation.php" method="GET">
                        <input type="hidden" name="id" value="<?= $row['id_vehicules'] ?>" />
                        <button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700">
                            Ajouter une note
                        </button>
                    </form>

                        <?php
                        }else{
                            ?>
                            <form action="./formreservation.php" method="GET">
                            <input type="hidden" name="id" value="<?= $row['id_vehicules'] ?>" />
                            <button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700">
                                Modifier une note
                            </button>
                        </form>
    
                            <?php
                        }
                        ?>
                        <!-- Add Rating Button -->
                        
                       
                    </td>
                </tr>
                <?php 
            endforeach
            ?>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
           
        <!-- CTA Button -->
        <div class="mt-6 text-center">
            <a href="./inde.php" class="bg-blue-600 text-white px-4 py-2 rounded-md font-medium hover:bg-blue-700">
                Réserver un autre véhicule
            </a>
        </div>
    </div>
</div>



</body>
</html>