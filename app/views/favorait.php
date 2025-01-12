<?php
session_start();
require_once __DIR__."/../controller/Article.php";

$idU = $_SESSION['user_id'];

$favorait = new Article();

$result = $favorait->getArticlesWithLikes($idU);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-50">

    <!-- Header -->
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
    <section class="relative bg-blue-900 text-white h-96">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Background Image -->
        <img src="./public/img/gallery/3.jpg" alt="Electric Car" class="w-full h-full object-cover">

        <!-- Content -->
        <div class="absolute inset-0 flex items-center justify-center text-center px-6">
            <div>
                <!-- Add Image Inside Hero -->
                <!-- <img src="./public/img/gallery/9.jpg" alt="Hero Image" class="mx-auto w-32 h-32 mb-6 rounded-full shadow-lg object-cover"> -->

                <h2 class="text-4xl font-bold mb-4">Welcome to the Future of Cars</h2>
                <p class="text-lg mb-6">
                    Explore the latest innovations, reviews, and trends in the automotive world.
                    Stay informed about electric vehicles, self-driving cars, and more.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16" id="articles">
        <!-- Articles Grid -->
        <div id="Tage_cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Article Card -->

            <?php foreach ($result as $row): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <img src="./public/img/gallery/1.jpg" alt="Article Image" class="w-full h-48 object-cover">
                    <div class="p-6 flex-1">
                        <h2 class="text-2xl font-semibold  text-gray-900 mb-4"><?= htmlspecialchars($row['title']) ?></h2>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($row['content']) ?></p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php
                            $tags = explode(',', $row['tags']);
                            foreach ($tags as $tag): ?>
                                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Learn More Button pinned at the bottom of the card -->
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div id="carModal" class="fixed hidden inset-0 bg-gray-900 bg-opacity-50  justify-center items-center z-50">
        <!-- Modal Content -->
        <div class="bg-gradient-to-br from-blue-900 to-gray-800 p-8 rounded-lg shadow-lg max-w-[50vw] mx-auto">
            <h2 class="text-2xl font-bold text-center text-yellow-400 mb-6">Add Your Article</h2>

            <!-- Form -->
            <form action="#" method="POST" class="space-y-6 w-[40vw] h-[60vh] overflow-y-auto p-4 bg-gray-100 rounded-lg" enctype="multipart/form-data">
                <!-- Title -->
                <input type="hidden" name="idT" value="<?= $idT ?>">
                <div class="relative">
                    <label for="car_title" class="text-sm font-medium text-gray-700">Car Title</label>
                    <input
                        type="text"
                        name="car_title"
                        id="car_title"
                        class="block w-full mt-1 px-4 py-2 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:border-yellow-500"
                        placeholder="Enter the car title (e.g., Tesla Model S)"
                        required />
                </div>

                <!-- Content -->
                <div class="relative">
                    <label for="car_content" class="text-sm font-medium text-gray-700">Car Description</label>
                    <textarea
                        name="car_content"
                        id="car_content"
                        rows="4"
                        class="block w-full mt-1 px-4 py-2 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:border-yellow-500"
                        placeholder="Describe the car (features, specs, etc.)"
                        required></textarea>
                </div>

                <!-- Image Upload -->
                <div class="relative">
                    <label for="car_image" class="text-sm font-medium text-gray-700">Car Image</label>
                    <input
                        type="file"
                        name="car_image"
                        id="car_image"
                        accept="image/*"
                        class="block w-full mt-1 px-4 py-2 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:border-yellow-500"
                        required />
                </div>

                <!-- Tags Selection -->
                <div class="relative">
                    <label for="car_tags" class="text-sm font-medium text-gray-700">Select Tags</label>
                     <select
                        name="car_tags"
                        id="car_tags"
                        multiple
                        class="block w-full mt-1 px-4 py-2 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:border-yellow-500">
                        <?php
                        $selectedTags =  explode(',', $row['tags']);
                        foreach ($selectedTags as $tag) :
                        ?>
                            <option value="<?=htmlspecialchars($tag['id']) ?>" ><?=htmlspecialchars($tag['name']) ?></option>';
                            <?php
                        endforeach
                        ?>
                    </select> 
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (or Command on Mac) to select multiple tags.</p>
                </div> 


                <!-- Submission Button -->
                <div class="flex justify-center items-center">
                    <button
                        type="submit"
                        name="add_car_theme"
                        class="w-[24vw] py-2 text-sm text-white bg-yellow-500 rounded-md shadow-md hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Expanded Article Details (Hidden by default) -->

    <!-- Footer -->
    <!-- <footer class="bg-blue-800 text-white py-6 text-center">
        <p>&copy; 2025 Car Blog. All rights reserved.</p>
    </footer> -->

</body>

</html>