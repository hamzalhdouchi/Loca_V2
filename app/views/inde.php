<?php


session_start();
$idUser = $_SESSION['user_id'];
require __DIR__ . "/../controller/VehiculeController.php";
require __DIR__ . "/../controller/ReservationController.php";
require __DIR__ . "/../controller/CategorieController.php";

$reservation = new reservation();
// global $id_vehicules;

$vehicule = new vehicule();

$categorei = new categorie();

$typecategorei = $categorei->getCategories();


$itemsPerPage = 9;

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;


$offset = ($currentPage - 1) * $itemsPerPage;


$vehicules = $vehicule->getVehicule($itemsPerPage, $offset);


$totalVehicules = $vehicule->countVehicules();
$totalPages = ceil($totalVehicules / $itemsPerPage);



if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["Détails"])) {
    $idV = $_POST['id'];

    $result = $vehicule->getSPisailVehicule($idV);
    echo "    

<script>
        document.addEventListener('DOMContentLoaded', function() {
const modal = document.getElementById('vehicleDetailsModal');
            modal.classList.toggle('hidden');
        });
    </script>


            
        ";
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Réserver'])) {

    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search = htmlspecialchars($_POST['searchI']);
    $filter = $_POST['categoreiID'];
    $result = $vehicule->afficherVoitureCategorie($filter);
    $result = $vehicule->search($search);
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de Voitures - Détails</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <style>
        .star-rating {
            display: flex;
            align-items: center;
        }

        .star-rating i {
            margin-right: 2px;
        }

        .star-rating .text-yellow-400 {
            color: #facc15;
            /* Yellow */
        }

        .star-rating .text-gray-300 {
            color: #d1d5db;
            /* Gray */
        }
    </style>
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
                    <a href="#" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-home mr-1"></i> Accueil
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </a>
                    <a href="./reservation.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bookmark mr-1"></i> Réservations
                    </a>
                    <a href="./them.php" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-newspaper mr-1"></i>
                    Blogs
                        </a>
                    <a href="./register.php"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                    </a>
                  
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-600 text-gray-600 h-[85vh] pt-24 pb-12" style="background-image: url('./public/img/gallery/image.png'); background-size: cover; background-position: center;">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Trouvez la voiture parfaite</h1>
            <p class="text-xl mb-8">Large sélection de véhicules à des prix compétitifs</p>
        </div>
    </div>

    <!-- Search bar -->
 <!-- Search and Filter Section -->
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input 
                type="text" 
                id="vehiculeInput" 
                placeholder="Rechercher un modèle..." 
                class="w-full px-4 py-2 border rounded-md"
                oninput="filterVehicles()">
            
            <select id="categoryFilter" class="w-full px-4 py-2 border rounded-md" onchange="filterVehicles()">
                <option value="" disabled selected>Filtrer par catégorie</option>
                <option id="chcey" value="">Tous</option>
                <!-- Remplir dynamiquement les catégories -->
                <?php foreach ($typecategorei as $categorie): ?>
                    <option value="<?php echo $categorie['nom']; ?>">
                        <?php echo $categorie['nom']; ?>
                    </option>
                <?php endforeach; ?>

                <!-- <button onclick(function gategory("ooo"))></button> -->
            </select>
        </div>
    </div>
</div>

    <!-- Filters -->
    <div class="max-w-7xl mx-auto mt-8 px-4">
        <div class="flex flex-wrap gap-4 mb-6">
            <button onclick="filterVehicles('all')"
                class="bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300">
                <i class="fas fa-car-side mr-1"></i> Toutes
            </button>
            <button onclick="filterVehicles('sedan')"
                class="bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300">
                <i class="fas fa-car mr-1"></i> Berlines
            </button>
            <button onclick="filterVehicles('suv')"
                class="bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300">
                <i class="fas fa-truck mr-1"></i> SUV
            </button>
            <button onclick="filterVehicles('utility')"
                class="bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300">
                <i class="fas fa-van-shuttle mr-1"></i> Utilitaires
            </button>
        </div>
    </div>
    <!-- Popup Modal -->
    <!-- Section des véhicules -->
    <div class="max-w-7xl mx-auto mt-8 px-4">
        <div id="vehicle-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($vehicules as $row): ?>
                <!-- Vehicle Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Image du véhicule -->
                    <img src="./public/img/gallery/3.jpg" alt="<?= htmlspecialchars($row['modele']); ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <!-- Modèle du véhicule -->
                        <p class="hidden"><?= htmlspecialchars($row['categorie_id']); ?></p>

                        <h3 class="text-xl font-semibold"><?= htmlspecialchars($row['modele']); ?></h3>

                        <!-- Description et prix -->
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-gray-600"><?= htmlspecialchars($row['description']); ?></span>
                            <span class="text-blue-600 font-bold"><?= htmlspecialchars($row['prix']); ?> DH</span>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="text-yellow-400">★★★★☆</span>
                                <span class="text-gray-600 ml-2">(4.0)</span>
                            </div>
                            <form action="./form.php" method="GET">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id_vehicules']) ?>">
                                <button type="submit" name="Réserver" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Réserver
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Pagination -->
    <div class="max-w-7xl mx-auto mt-8 px-4 pb-8">
        <div class="flex justify-center items-center space-x-2">
            <?php if ($currentPage > 1): ?>
                <button class="px-4 py-2 border rounded-md hover:bg-gray-100">
                    <a href="?page=<?= $currentPage - 1; ?>">Précédent</a>
                </button>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <button class="px-4 py-2 border rounded-md <?= $i === $currentPage ? 'bg-blue-600 text-white' : 'hover:bg-gray-100'; ?>">
                    <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                </button>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <button class="px-4 py-2 border rounded-md hover:bg-gray-100">
                    <a href="?page=<?= $currentPage + 1; ?>">Suivant</a>
                </button>
            <?php endif; ?>
        </div>
    </div>



    <!-- Vehicle Details Modal -->
    <div id="vehicleDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-10">
        <div class="w-screen h-screen flex justify-center items-center">
            <div class="w-[80vw] h-[60vh] bg-white flex justify-center items-center rounded-xl relative">
                <!-- Bouton de fermeture -->
                <button
                    onclick="toggleModall('vehicleDetailsModal')"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
                    aria-label="Fermer le popup">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-[70vw] h-[40vh] mx-auto rounded-xl bg-white">
                    <!-- Image Section -->
                    <img src="<?= htmlspecialchars($result['image']) ?>" alt="<?= htmlspecialchars($result['modele']) ?>" class="w-full h-64 object-cover rounded-lg">

                    <!-- Vehicle Info Section -->
                    <div>
                        <h4 class="text-2xl font-bold mb-4"><?= htmlspecialchars($result['modele']) ?></h4>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($result['description']) ?></p>

                        <!-- Features -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                5 portes
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Climatisation
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                GPS
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Bluetooth
                            </div>
                        </div>
                        <!-- Price and Reserve Button -->
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">
                                <?= htmlspecialchars($result['prix']) ?>$/jour
                            </span>
                            <form action="./from.php" method="GET">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id_vehicules']) ?>">
                                <button type="submit" name="Réserver" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Réserver maintenant
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Footer Top Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About Section -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">AutoLoc</h3>
                    <p class="text-sm text-gray-400">
                        AutoLoc est votre plateforme de location de voitures fiable et pratique. Trouvez le véhicule parfait pour vos besoins à des prix compétitifs.
                    </p>
                </div>
                <!-- Links Section -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens Utiles</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:underline">Accueil</a></li>
                        <li><a href="#" class="hover:underline">Véhicules</a></li>
                        <li><a href="#" class="hover:underline">Réservations</a></li>
                        <li><a href="#" class="hover:underline">Contactez-nous</a></li>
                    </ul>
                </div>
                <!-- Contact Section -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-phone-alt mr-2"></i> +212 6 12 34 56 78</li>
                        <li><i class="fas fa-envelope mr-2"></i> support@autoloc.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Casablanca, Maroc</li>
                    </ul>
                </div>
            </div>
            <!-- Footer Bottom Section -->
            <div class="mt-8 text-center text-gray-500 text-sm">
                © 2025 AutoLoc. Tous droits réservés.
            </div>
        </div>
    </footer>





    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- JavaScript -->
    <script>


const vehicles = 



// Fonction pour afficher les véhicules
function displayVehicles(vehicles) {
    const vehicleGrid = document.getElementById('vehicle-grid');
    vehicleGrid.innerHTML = ''; // Vider le conteneur avant de remplir
    
    if (vehicles.length === 0) {
        vehicleGrid.innerHTML = '<p class="text-gray-500 col-span-full text-center">Aucun véhicule trouvé.</p>';
        return;
    }

    vehicles.forEach(vehicle => {
        const vehicleCard = `
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="./public/img/gallery/${vehicle.image}" alt="${vehicle.modele}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold">${vehicle.modele}</h3>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-gray-600">${vehicle.description}</span>
                        <span class="text-blue-600 font-bold">${vehicle.prix} DH</span>
                    </div>
                </div>
            </div>
        `;
        vehicleGrid.innerHTML += vehicleCard;
    });
}

// Fonction pour filtrer les véhicules
function filterVehicles() {
    const searchInput = document.getElementById('vehiculeInput').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();

    const filteredVehicles = vehicules.filter(vehicle => {
        const matchesModel = vehicle.modele.toLowerCase().includes(searchInput);
        const matchesCategory = categoryFilter ? vehicle.categorie.toLowerCase() === categoryFilter : true;
        return matchesModel && matchesCategory;
    });

    displayVehicles(filteredVehicles);
}

// Affichage initial de tous les véhicules
displayVehicles(vehicules);








// function gategory 
// jibe valeu dyale option par example ooo 
// foreach voiture if ooo ===  htmlspecialchars($row['categorie_id']); 


        document.getElementById("reserver").addEventListener('onsubmit', function(event) {
            event.preventDefault();
            console.log(event.target.parentElement);
        })

        // Toggle modal visibility
        function toggleModall(modall) {
            const modal = document.getElementById(modall);
            modal.classList.toggle('hidden');
        }
        const modal = document.getElementById('vehicleDetailsModal');
        modal.addEventListener('click', function(e) {

            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });



        function toggleModal() {
            const modal = document.getElementById('reservationModal');
            modal.classList.toggle('hidden');
        }
        document.getElementById("category").addEventListener("change", function() {
            const category = this.value;
            ""
            fetch("./filter.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `category=${encodeURIComponent(category)}`,
                })
                .then((response) => response.json())
                .then((vehicules) => {
                    const vehiculeGrid = document.getElementById("vehicle-grid");

                    if (!vehiculeGrid) {
                        console.error("Element vehicle-grid not found.");
                        return;
                    }

                    vehiculeGrid.innerHTML = "";

                    if (vehicules.length === 0) {
                        vehiculeGrid.innerHTML = `
                    <p class="text-gray-500">Aucun véhicule trouvé pour cette catégorie.</p>
                `;
                        return;
                    }

                    vehicules.forEach((vehicule) => {
                        vehiculeGrid.innerHTML += `
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Image du véhicule -->
                        <img src="../../folder/${vehicule.image}" alt="${vehicule.model}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <!-- Modèle du véhicule -->
                            <h3 class="text-xl font-semibold">${vehicule.model}</h3>

                            <!-- Description et prix -->
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-gray-600">${vehicule.description}</span>
                                <span class="text-blue-600 font-bold">${vehicule.prix} DH</span>
                            </div>

                            <!-- Évaluation et bouton réserver -->
                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★★★★☆</span>
                                    <span class="text-gray-600 ml-2">(4.0)</span>
                                </div>
                                <form action="./form.php" method="GET">
                                    <input type="hidden" name="id" value="${vehicule.id}">
                                    <button type="submit" name="Réserver" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        Réserver
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                    });
                })
                .catch((error) => {
                    console.error("Erreur lors de la récupération des véhicules :", error);
                });
        });
    </script>
</body>

</html>