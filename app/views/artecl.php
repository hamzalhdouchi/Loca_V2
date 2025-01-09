<?php
require __DIR__ . "/../controller/Article.php";
require __DIR__ . "/../controller/tags.php";

$tag = new Tags();

$tags = $tag->getTags();

var_dump($tags);

$idT = $_GET['id'];

$article = new Article();


$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

$limit = $itemsPerPage;
$offset = ($currentPage - 1) * $itemsPerPage;

$articles = $article->getArticleWithTags($limit, $offset);

$totalArticles = $article->countArticle(); 
$totalPages = ceil($totalArticles / $itemsPerPage);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_car_theme'])) {
    $idt = intval($_POST['idT']);
    $title = htmlspecialchars($_POST['car_title']);
    $content = htmlspecialchars($_POST['car_content']);
    $tags = $_POST['car_tags'];

    $image = $_FILES['car_image'];
    $article->setArticle($idt, $title, $content, $image, $tags);
}
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
    <header class="bg-blue-900 text-white py-3 px-6 shadow-md">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="./index.php" class="flex items-center">
                <i class="fas fa-car-side text-2xl text-white mr-2"></i>

                <h1 class="text-2xl font-bold tracking-wide">Car Blog</h1>
            </a>

            <!-- Navigation Links -->
            <nav class="flex items-center space-x-6 text-sm font-medium">
                <a href="./them.php" class="hover:text-yellow-400 transition-colors duration-200">Themes</a>
                <a href="#about" class="hover:text-yellow-400 transition-colors duration-200">About</a>
                <a href="#contact" class="hover:text-yellow-400 transition-colors duration-200">Contact</a>
            </nav>

            <!-- Call to Action Button -->
            <a href="./inde.php" class="bg-yellow-500 text-blue-900 py-2 px-4 rounded-lg text-sm font-semibold hover:bg-yellow-600 transition-colors duration-300">
                Explore Cars
            </a>
        </div>
    </header>


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
                <button onclick="openModalBtn()" class="bg-yellow-500 text-blue-900 font-semibold py-2 px-6 rounded-lg hover:bg-yellow-600">
                    Explore Articles
                </button>
            </div>
        </div>
    </section>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16" id="articles">
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Article Card -->
            <!--  -->
            <?php foreach ($articles as $row): ?>
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
                    <div class="mt-auto p-4 border-t border-gray-200">
                        <a href="./articleditels.php?id=<?= $row['id'] ?>" class="bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300 w-full text-center block">
                            Learn More
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

   <!-- Pagination -->
   <div class="max-w-7xl mx-auto mt-8 px-4 pb-8">
        <div class="flex justify-center items-center space-x-2">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="px-4 py-2 border rounded-md hover:bg-gray-100">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-4 py-2 border rounded-md <?= $i === $currentPage ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="px-4 py-2 border rounded-md hover:bg-gray-100">Next</a>
            <?php endif; ?>
        </div>
    </div>

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
                        $selectedTags = isset($row['tags']) ? explode(',', $row['tags']) : [];
                        foreach ($tags as $tag) {
                            $isSelected = in_array($tag['name'], $selectedTags) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($tag['id']) . '" ' . $isSelected . '>' . htmlspecialchars($tag['name']) . '</option>';
                        }
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

    <script>
        function toggleArticleDetails() {
            const details = document.getElementById('article-details');
            details.classList.toggle('hidden');
        };
        const modal = document.getElementById('carModal');

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

    <!-- Footer -->
    <footer class="bg-blue-800 text-white py-6 text-center">
        <p>&copy; 2025 Car Blog. All rights reserved.</p>
    </footer>

</body>

</html>