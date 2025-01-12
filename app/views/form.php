<?php
session_start();
if (!$_SESSION) {
    header('Location: ./register.php');
exit();
}

$idUser = $_SESSION['user_id'];
require __DIR__."/../controller/VehiculeController.php";
require __DIR__."/../controller/ReservationController.php";

$reservation = new reservation();
$vehicule = new vehicule();

$idUser = $_SESSION['user_id'];
$idV = $_GET['id'];

$result = $vehicule->getSPisailVehicule($idV);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Confirmer'])) {
    $adresse = $_POST['street'];
    $date = $_POST['startDate'];
    $idv = $_POST['id'];
    $idUser = $_POST['user'];
    $reservation->setDateReservation($date);
    $reservation->setAdresseLivraison($adresse);
    $reservation->AjouterReservation($idUser, $idv);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<div id="reservationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative">
        <a href="./inde.php" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            <i class="fas fa-times text-xl"></i>
        </a>
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
    Réservation
</h2>
<form class="space-y-6" method="POST">
    <input type="hidden" name="user" value="<?= $idUser ?>">
    <input type="hidden" name="id" value="<?= $result['id_vehicules'] ?>">
    <div>
    <label for="startDate" class="block text-sm font-medium text-gray-700">
        Date de début <span class="text-red-500">*</span>
    </label>
    <div class="relative mt-2">
        <i class="fas fa-calendar absolute left-4 top-3 text-gray-400"></i>
        <input 
            type="datetime-local" 
            id="startDate"
            name="startDate"
            required
            class="border rounded-lg p-3 pl-12 w-full focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none"
        >
    </div>
</div>
<div>
    <label for="street" class="block text-sm font-medium text-gray-700">
        Adresse de prise en charge <span class="text-red-500">*</span>
    </label>
    <div class="relative mt-2">
        <i class="fas fa-map-marker-alt absolute left-4 top-3 text-gray-400"></i>
        <input 
            type="text" 
            id="street"
            name="street"
            placeholder="123 rue de la République"
            required
            class="border rounded-lg p-3 pl-12 w-full focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none"
        >
    </div>
</div>
<div class="flex justify-end pt-4">
    <button 
        type="submit"
        name="Confirmer"
        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200"
    >
        Confirmer
    </button>
</div>
</form>
</div>
</div>
</body>
</html>
