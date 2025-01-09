<?php 


require __DIR__."/../controller/themes.php";
    $idT = $_GET['id_M'];
   $themes =new themes();
    $result = $themes->ModiferTheme($idT);
    

    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['ModifierTheme'])) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['created_date']);
    $idT = intval($_POST['id_T']);
    $themes->Modifer($idT,$name,$description,$date);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="./assets/css/css/dach.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    
<div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 z-50">
    <!-- Contenu de la modal (formulaire) -->
    <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Ajouter une Theme</h2>
        <!-- Formulaire -->
        <form action="./themeAdmin.php" method="POST" class="space-y-4 w-[40vw] h-[50vh] overflow-y-auto p-4 bg-gray-100 rounded-lg" enctype="multipart/form-data">
            <!-- Nom -->
            <div id="formTheme">
                <input type="hidden" name='id_T' value="<?= $idT ?>">

                <!-- Initial Fields -->
                <div class="relative">
                    <label for="name_0" class="text-xs font-medium text-gray-600">Nom</label>
                    <input type="text" name="name" id="name_0"
                        value="<?=htmlspecialchars($result['name'] )?>"
                        class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500"
                        placeholder="Entrez le nom" required />
                </div>

                <div class="relative">
                    <label for="description_0" class="text-xs font-medium text-gray-600">Description</label>
                    <textarea name="description" id="description_0" rows="3"
                        class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500"
                        placeholder="Ajoutez une description" required><?= htmlspecialchars($result['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>

                <div class="relative">
                    <label for="created_date_0" class="text-xs font-medium text-gray-600">Date de Création</label>
                    <input 
                        type="date" 
                        name="created_date"  
                        id="created_date_0"
                        value="<?= htmlspecialchars($result['created_Date']) ?>"
                        class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500"
                        required />
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-center items-center">
                <button type="submit" name="ModifierTheme" class="w-[30vw] py-2 text-sm text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    Soumettre
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>