<?php 
session_start();
if (!$_SESSION) {
    header('Location: ./register.php');
exit();
}

require __DIR__."/../controller/AvisController.php";

   $idU =  $_SESSION['user_id'];
   $idV = $_GET['id'];
   $avis =new avis();

   if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['rating'])) {
    $star = $_POST['stars'];
    $message = $_POST['message'];
    $avis->SetAvis($idU,$idV,$star,$message);
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une note</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .star-yellow {
            color: #facc15; /* Tailwind's yellow-400 color */
        }
        .star-gray {
            color: #d1d5db; /* Tailwind's gray-300 color */
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-xl w-full max-w-md transform hover:scale-105 transition duration-300 p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">
            ⭐ Ajouter une Note
        </h1>
        <p class="text-gray-600 text-center mb-6">
            Merci de nous donner votre avis sur votre expérience.
        </p>
        <form action="" method="POST">
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">
                    Votre note (1 à 5):
                </label>
                <div class="relative">
                    <select name="stars" class="block w-full bg-gray-100 border border-gray-300 rounded-lg py-3 px-4 focus:ring focus:ring-blue-300 focus:outline-none text-gray-700 font-medium">
                        <option value="1">⭐ Très mauvais</option>
                        <option value="2">⭐⭐ Mauvais</option>
                        <option value="3">⭐⭐⭐ Moyen</option>
                        <option value="4">⭐⭐⭐⭐ Bon</option>
                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                    </select>
                </div>
            </div>

            <!-- Message input field -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">
                    Votre message:
                </label>
                <textarea name="message" rows="4" class="block w-full bg-gray-100 border border-gray-300 rounded-lg py-3 px-4 focus:ring focus:ring-blue-300 focus:outline-none text-gray-700 font-medium" placeholder="Écrivez votre avis..." require></textarea>
            </div>

            <button name="rating" type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                Confirmer
            </button>
        </form>
    </div>
</body>

</html>
