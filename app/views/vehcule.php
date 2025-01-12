<?php
session_start();
if (!$_SESSION) {
    header('Location: ./register.php');
    exit();
}
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/VehiculeController.php";
require __DIR__ . "/../controller/CategorieController.php";
$vehicule = new vehicule();

$vehicules = $vehicule->getVehiculees();
$categorei = new categorie();

$categoreis = $categorei->getCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['disponeble'])) {
    $despo = $_POST['despo'];
    $id = $_POST['id'];

    if (isset($id)) {
        $vehicleObj = new vehicule();
        $vehicleObj->Setdisponible($despo, $id);
    } else {
        echo "L'ID du véhicule est manquant.";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET'  && isset($_GET['modification'])) {

    $result = $vehicule->UPDATEVehucule($_GET['modifer']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Modifier'])) {

    $vehicule->ModifierVéhicule($_POST['id'], $_POST['model'], $_POST['description'], $_POST['prix'], $_POST['disponibilite'], $_POST['categorie_id']);

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ModaLModifier = document.getElementById('mood');
        ModaLModifier.classList.remove('hidden');
        ModaLModifier.classList.add('flex');
    });
</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer'])) {
    $id = $_POST['supprimerV'];

    $vehicule->deletevehicules($id);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Ajouter'])) {
    $idCount = $_POST['id'];


    $vehicule->AjouteMulti($idCount, $_POST, $_FILES);
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

<input type="checkbox" id="menu-toggle">
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
                        <a href="./categorei.php">
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
                        <a href="./themeAdmin.php" class="active">
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
    </div>

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
        </div>
    </main>
                </div>
                <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
                    <!-- Contenu de la modal (formulaire) -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
                        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Ajouter un Véhicule</h2>
                        <!-- Formulaire -->
                        <form action="#" method="POST" class="space-y-4 w-[40vw] h-[50vh] overflow-y-auto p-4 bg-gray-100 rounded-lg" enctype="multipart/form-data">

                            <!-- Catégorie -->
                            <div class="relative">
                                <label for="categorie_id" class="text-xs font-medium text-gray-600">Catégorie</label>
                                <select name="categorie_id" id="categorie_id" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" required>
                                    <option value="" disabled selected>Sélectionnez une catégorie</option>
                                    <?php
                                    foreach ($categoreis as $row) {
                                    ?>
                                        <option value="<?= htmlspecialchars($row['id_categories']) ?>"><?= htmlspecialchars($row['nom']) ?></option>
                                    <?php } ?>


                                </select>
                            </div>


                            <!-- Modèle -->
                            <div id="formA">
                                <input type="hidden" name="id" value="0" />
                                <div class="relative">
                                    <label for="floating_model" class="text-xs font-medium text-gray-600">Modèle du véhicule</label>
                                    <input type="text" name="model_0" id="floating_model" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. Toyota Corolla" required />
                                </div>

                                <!-- Catégorie -->



                                <!-- Disponibilité -->
                                <div class="relative">
                                    <label for="disponibilite" class="text-xs font-medium text-gray-600">Disponibilité</label>
                                    <select name="disponibilite_0" id="disponibilite" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" required>
                                        <option value="" disabled selected>Disponibilité</option>
                                        <option value="1">Disponible</option>
                                        <option value="0">Non disponible</option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="relative">
                                    <label for="description" class="text-xs font-medium text-gray-600">Description</label>
                                    <textarea name="description_0" id="description" rows="2" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Description du véhicule" required></textarea>
                                </div>

                                <!-- Prix -->
                                <div class="relative">
                                    <label for="prix" class="text-xs font-medium text-gray-600">Prix (en MAD)</label>
                                    <input type="number" name="prix_0" id="prix" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. 250000" required />
                                </div>

                                <!-- Image -->
                                <div class="relative">
                                    <label for="image" class="text-xs font-medium text-gray-600">Image du véhicule</label>
                                    <input type="file" name="image_0" id="image" accept="image/*" class="block w-full mt-1 text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-100 file:text-blue-600 hover:file:bg-blue-200" required />
                                </div>

                            </div>
                            <!-- Bouton de soumission -->
                            <div class="flex justify-around items-center">

                                <button type="button" onclick="ajouterMult()" class="w-[10vw] py-2 text-sm text-white bg-lime-500 rounded-md shadow-md hover:bg-lime-600 focus:ring-2 focus:ring-lime-400 focus:outline-none font-bold"> + </button>
                                <button type="submit" name="Ajouter" class="w-[24vw] py-2 text-sm text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
                        <button type="button" onclick="openModalBtn()">Add record</button>

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
                                <th><span class="las la-sort"></span> modele</th>
                                <th><span class="las la-sort"></span>prix/jour </th>
                                <th><span class="las la-sort"></span> disponibilite</th>

                                <th><span class="las la-sort"></span> ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($vehicules as $row) {

                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_vehicules']) ?></td>
                                    <td>
                                        <div class="client">
                                            <div class="client-img bg-img" style="background-image: url(<?= htmlspecialchars($row['image']) ?>)"></div>
                                            <div class="client-info">
                                                <h4><?= htmlspecialchars($row['modele']) ?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h4><?= htmlspecialchars($row['prix']) ?></h4>
                                    </td>
                                    <?php
                                    if ($row['disponibilite'] == 0) { ?>
                                        <td> <span class="reserved-badge bg-gradient-to-r from-red-400 to-red-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md inline-block">
                                                <form action="./vehcule.php" method="POST" class="m-0 p-0">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id_vehicules']) ?>">
                                                    <input type="hidden" value="1" name="despo">
                                                    <button
                                                        class="w-full bg-transparent text-white font-semibold cursor-pointer focus:outline-none px-0 py-0"
                                                        type="submit"
                                                        name="disponeble">
                                                        No disponible
                                                    </button>
                                                </form>
                                            </span>
                                        <?php
                                    } elseif ($row['disponibilite'] == 1) {
                                        ?>
                                        <td>
                                            <span class="reserved-badge bg-gradient-to-r from-green-400 to-green-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md inline-block">
                                                <form action="./vehcule.php" method="POST" class="m-0 p-0">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id_vehicules']) ?>">
                                                    <input type="hidden" value="0" name="despo">
                                                    <button
                                                        class="w-full bg-transparent text-white font-semibold cursor-pointer focus:outline-none px-0 py-0"
                                                        type="submit"
                                                        name="disponeble">
                                                        Disponible
                                                    </button>
                                                </form>
                                            </span>
                                        </td>

                                    <?php
                                    }
                                    ?>
                                    <td>
                                        <div class="flex gap-5">
                                            <form action="" method="GET">
                                                <input type="hidden" value="<?= htmlspecialchars($row['id_vehicules']) ?>" name="modifer">
                                                <button type="submit" name="modification" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><i class="fa-solid fa-gear"></i></button>
                                            </form>
                                            <form action="./vehcule.php" method="POST">
                                                <input type="hidden" value="<?= htmlspecialchars($row['id_vehicules']) ?>" name="supprimerV">
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




















    <div id="mood" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
        <!-- Contenu de la modal (formulaire) -->
        <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Modification de véhicule</h2>
            <!-- Formulaire -->
            <form action="#" method="POST" class="space-y-4 w-[40vw] h-[50vh] overflow-y-auto p-4 bg-gray-100 rounded-lg" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($result['id_vehicules']) ?>">


                <!-- Modèle -->

                <div class="relative">
                    <label for="floating_model" class="text-xs font-medium text-gray-600">Modèle du véhicule</label>
                    <input type="text" value="<?= htmlspecialchars($result['modele']) ?>" name="model" id="floating_model" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. Toyota Corolla" required />
                </div>

                <!-- Catégorie -->
                <div class="relative">
                    <label for="categorie_id" class="text-xs font-medium text-gray-600">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" required>
                        <option value="" disabled selected>Sélectionnez une catégorie</option>
                        <?php
                        foreach ($categoreis as $row) {
                        ?>
                            <option value="<?= htmlspecialchars($row['id_categories']) ?>"><?= htmlspecialchars($row['nom']) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Disponibilité -->
                <div class="relative">
                    <label for="disponibilite" class="text-xs font-medium text-gray-600">Disponibilité</label>
                    <select name="disponibilite" id="disponibilite" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" required>
                        <option value="" disabled selected>Disponibilité</option>
                        <option value="1">Disponible</option>
                        <option value="0">Non disponible</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="relative">
                    <label for="description" class="text-xs font-medium text-gray-600">Description</label>
                    <textarea name="description" value="<?= htmlspecialchars($result['description']) ?>" id="description" rows="2" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Description du véhicule" required></textarea>
                </div>

                <!-- Prix -->
                <div class="relative">
                    <label for="prix" class="text-xs font-medium text-gray-600">Prix (en MAD)</label>
                    <input type="number" name="prix" value="<?= htmlspecialchars($result['prix']) ?>" id="prix" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. 250000" required />
                </div>
        </div>
        <!-- Bouton de soumission -->
        <div class="flex justify-around items-center">
            <button type="submit" name="Modifier" class="w-full py-2 text-sm text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                Soumettre
            </button>
        </div>
        </form>



    </div>




    </main>
    <script src="./assets/css/JS/scripte.js"></script>

</body>

</html>