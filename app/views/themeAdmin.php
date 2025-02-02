<?php
session_start();
$userName = $_SESSION['user_name'];
require __DIR__ . "/../controller/themes.php";

$themes = new themes();

$result = $themes->getThemes();

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['supprimer'])) {
    $id = intval($_POST['supprimerV']);
    $themes->deleteTheme($id);
}

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['AjouterTheme'])) {
    $cont = $_POST['cont'];
    $themes->addTheme($cont, $_POST);
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


            <div class="records table-responsive">

                <div class="record-header">
                    <div class="add">
                        <span>Entries</span>
                        <select name="" id="">
                            <option value="">ID</option>
                        </select>
                        <button onclick="openModalBtn()">Add Theme</button>
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
                                <th><span class="las la-sort"></span> name</th>
                                <th><span class="las la-sort"></span> discrption</th>
                                <th><span class="las la-sort"></span>Date de creation</th>

                                <th><span class="las la-sort"></span> ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td>
                                        <div class="client">
                                            
                                            <div class="client-info">
                                                <h4><?= htmlspecialchars($row['name']) ?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h4><?= htmlspecialchars($row['description']) ?></h4>
                                    </td>
                                    <td><?= htmlspecialchars($row['created_Date']) ?></td>
                                    <td>
                                        <div class="flex gap-5">
                                            <form action="./formethemes.php" method="get">
                                                <input type="hidden" value="<?= htmlspecialchars($row['id']) ?>" name="id_M">
                                                <button
                                                    type="submit"
                                                    name="modifier"
                                                    class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                    <i class="fa-solid fa-gear"></i>
                                                </button>
                                            </form>

                                            <form action="" method="POST">
                                                <input type="hidden" value="<?= htmlspecialchars($row['id']) ?>" name="supprimerV">
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

    </main>

    </div>

    <div id="modal" class="fixed hidden inset-0 bg-gray-900 bg-opacity-50 justify-center items-center z-50">
        <!-- Contenu de la modal (formulaire) -->
        <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Ajouter une Theme</h2>
            <!-- Formulaire -->
            <form action="#" method="POST" class="space-y-4 w-[40vw] h-[50vh] overflow-y-auto p-4 bg-gray-100 rounded-lg" enctype="multipart/form-data">
                <!-- Nom -->
                <div id="formTheme">
                    <input type="hidden" name="cont" value="0">

                    <!-- Initial Fields -->
                    <div class="relative">
                        <label for="name_0" class="text-xs font-medium text-gray-600">Nom</label>
                        <input type="text" name="name_0" id="name_0"
                            class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500"
                            placeholder="Entrez le nom" required />
                    </div>

                    <div class="relative">
                        <label for="description_0" class="text-xs font-medium text-gray-600">Description</label>
                        <textarea name="description_0" id="description_0" rows="3"
                            class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500"
                            placeholder="Ajoutez une description" required></textarea>
                    </div>

                    <div class="relative">
                        <label for="created_date_0" class="text-xs font-medium text-gray-600">Date de Création</label>
                        <input type="date" name="created_date_0" id="created_date_0"
                            class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500"
                            required />
                    </div>
                </div>



                <!-- Bouton de soumission -->
                <div class="flex justify-around items-center">
                    <button type="button" onclick="MultiThemes()" class="w-[10vw] py-2 text-sm text-white bg-lime-500 rounded-md shadow-md hover:bg-lime-600 focus:ring-2 focus:ring-lime-400 focus:outline-none font-bold"> + </button>
                    <button type="submit" name="AjouterTheme" class="w-[24vw] py-2 text-sm text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        Soumettre
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="./assets/css/JS/scripte.js"></script>
    <script>
        const modal = document.getElementById('modal');

        function openModalBtn() {


            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>