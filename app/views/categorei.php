<?php
// require __DIR__ . "/../controller/VehiculeController.php";
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/CategorieController.php";
$categorei = new categorie();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AjouterCa'])) {
    $id = $_POST['id_c'];
    $categorei->ajoutCategorie($id, $_POST);
}
$result = $categorei->getCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer'])) {
    
    $categorei->deleteCategorie($_POST['supprimerV']);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['modifier'])) {
    $id = $_GET['id_M'];
    $results = $categorei->Getmodifier($id);

    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const ModaLModifier = document.getElementById('ModaLModifier');
            ModaLModifier.classList.remove('hidden');
            ModaLModifier.classList.add('flex');
        });
    </script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['modification'])) {
    
    $categorei->UPDATE($_POST['id'],$_POST['nom'],$_POST['description']);
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
    <style>
        /* Style pour le modal (popup) */
        #modal {
            /* display: none; */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Fond sombre */
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Contenu du modal */
        #modal .bg-white {
            position: relative;
            padding: 2rem;
            border-radius: 10px;
            max-width: 700px;
            width: 100%;
        }

        /* Style pour le bouton de fermeture (facultatif) */
        #modal .close-btn {
            position: absolute;
            top: 0.5rem;
            right: 1rem;
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            color: #000;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="sidebar">
     <div class="side-header">
            <h3>M<span>odern</span></h3>
        </div>

        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                <h4><?= $userName ?></h4>
                <small>Director</small>
            </div>

           
            <div class="side-menu">
                <ul>
                    <li>
                        <a href="./Dach.php">
                            <span class="las la-user-alt"></span>
                            <small>users</small>
                        </a>
                    </li>
                    <li>
                        <a href="./categorei.php" class="active">
                            <span class="las la-th-large"></span>
                            <small>categorei</small>
                        </a>
                    </li>
                    <li>
                        <a href="./vehcule.php">
                            <span class="las la-car"></span>
                            <small>véhcule</small>
                        </a>
                    </li>
                    <li>
                        <a href="./reservationAdmin.php">
                            <span class="las la-clipboard-check"></span>
                            <small>reservation</small>
                        </a>
                    </li>
                    <li>
                        <a href="./evaluations.php">
                            <span class="las la-star"></span>
                            <small>Avis</small>
                        </a>
                    </li>
                    <li>
                        <a href="./themeAdmin.php">
                            <span class="las la-tasks"></span>
                            <small>Theme</small>
                        </a>
                    </li>
                    <li>
                        <a href="./ArticleAdmin.php">
                            <span class="las la-newspaper"></span> <!-- Newspaper icon -->
                            <small>Article</small>
                        </a>
                    </li>
                    <li>
                        <a href="./tagAdmiun.php" >
                            <span class="las la-tag"></span> <!-- Tag icon -->
                            <small>Tag</small>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
     </div>  <input type="checkbox" id="menu-toggle">
  

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <label for="">
                        <span class="las la-search"></span>
                    </label>

                    <div class="notify-icon">
                        <span class="las la-envelope"></span>
                        <span class="notify">4</span>
                    </div>

                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">3</span>
                    </div>

                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>

                        <span class="las la-power-off"></span>
                        <span><a href="./register.php">Logout</a></span>
                    </div>
                </div>
            </div>
        </header>


        <main>

            <div class="page-header">
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>


            <div class="page-content">

                <div class="analytics">

                    

    </div>
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
        <!-- Contenu de la modal (formulaire) -->
        <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Ajouter un Véhicule</h2>
            <!-- Formulaire -->
            <form id="vehicule-form" action="#" method="POST" class="space-y-4 w-[40vw] h-[50vh] overflow-y-auto p-4 bg-gray-100 rounded-lg" enctype="multipart/form-data">

                <div id="formC">
                    <div class="vehicule-entry">
                        <input type="hidden" name="id_c" value="0">
                        <div class="relative">
                            <label for="nom_0" class="text-xs font-medium text-gray-600">Nom du véhicule</label>
                            <input type="text" name="nom_0" id="nom_0" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. Toyota Corolla" required />
                        </div>

                        <div class="relative">
                            <label for="description_0" class="text-xs font-medium text-gray-600">Description</label>
                            <textarea name="description_0" id="description_0" rows="2" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Description du véhicule" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-around items-center">
                    <button type="button" onclick="MultiCa()" class="w-[10vw] py-2 text-sm text-white bg-lime-500 rounded-md shadow-md hover:bg-lime-600 focus:ring-2 focus:ring-lime-400 focus:outline-none font-bold"> + </button>
                    <button type="submit" name="AjouterCa" class="w-[24vw] py-2 text-sm text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        Soumettre
                    </button>
                </div>
            </form>
        </div>
    </div>

    </div>

    <div class="records table-responsive">

        <div class="record-header">
            <div class="add">
                <span>Entries</span>
                <select name="" id="">
                    <option value="">ID</option>
                </select>
                
                <button type="button" onclick="openModalBtn()">Add category</button>
            </div>

            <div class="browse">
                <input type="search" placeholder="Search" class="record-search">
                <select name="" id="">
                    <option value="">Status</option>
                </select>
            </div>
        </div>

        <div>
            <table width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><span class="las la-sort"></span> Name Categorei</th>
                        <th><span class="las la-sort"></span>description</th>
                        <th><span class="las la-sort"></span> ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row) {
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_categories']) ?></td>
                            <td>
                                <div class="client">

                                    <div class="client-info">
                                        <h4><?= htmlspecialchars($row['nom']) ?></h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h4><?= htmlspecialchars($row['description']) ?></h4>
                            </td>



                            <td>
                                <div class="flex gap-5">
                                    <form action="" method="get">
                                        <input type="hidden" value="<?= htmlspecialchars($row['id_categories']) ?>" name="id_M">
                                        <button
                                            type="submit"
                                            name="modifier"
                                          
                                            class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>
                                    </form>

                                    <form action="" method="POST">
                                        <input type="hidden" value="<?= htmlspecialchars($row['id_categories']) ?>" name="supprimerV">
                                        <button type="submit" name="supprimer" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    </div>

    <div id="ModaLModifier" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier Catégorie</h2>
            <!-- Form inside the modal -->
            <form action="" method="post">
                <!-- Hidden Input -->
                <input type="hidden" name="id" value="<?= $id ?>">

                <!-- Input: Nom -->
                <div class="mb-6">
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        value="<?= htmlspecialchars($results['nom']) ?>"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Entrez le nom de la catégorie">
                </div>

                <!-- Textarea: Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Entrez une description"><?= htmlspecialchars($results['description'])?></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end">
                    <!-- Cancel Button -->
                    <button
                        type="button"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md mr-3 hover:bg-gray-600 transition"
                        onclick="showModal(event)">
                        Annuler
                    </button>
                    <!-- Submit Button -->
                    <button
                        type="submit"
                        name="modification"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>




    </main>
    <script src="./assets/css/JS/scripte.js"></script>
    <script>
        function openModalBtn() {

            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });

        function showModal(event) {
            event.preventDefault();
            console.log("showModal function triggered");

            const ModaLModifier = document.getElementById('ModaLModifier');
            ModaLModifier.classList.toggle('hidden');
            ModaLModifier.classList.add('flex');
        };

        ModaLModifier.addEventListener('click', function(e) {
            if (e.target === ModaLModifier) {
                ModaLModifier.classList.remove('flex');
                ModaLModifier.classList.add('hidden');
            }
        });
    </script>

</body>

</html>