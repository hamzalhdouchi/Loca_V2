<?php 
session_start();
$user = $_SESSION['user_name'];
require __DIR__."/../controller/themes.php";

$themes = new themes();

$theme = $themes->getTemes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600">CarBlog</span>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="./inde.php" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Blog</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Contact</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="py-4">
                <div class="relative">
                    <input type="text" placeholder="Search articles..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-12 mt-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Blog Posts -->
        <?php 
        foreach ($theme as $row):
        ?>
        <div class="lg:col-span-2">
            <!-- Blog Post Card -->
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <!-- Card 1 -->
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="property-item rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 bg-white">
                                <!-- Image and Actions -->
                                <div class="relative overflow-hidden">
                                    <a href="#">
                                        <img class="w-full h-64 object-cover transition-transform duration-300 transform hover:scale-110"
                                            src="./public/img/gallery/2.jpg" alt="Article Image">
                                    </a>
                                    <button class="absolute top-3 right-3 text-white hover:text-red-500 text-2xl transition-all duration-300">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                    <div class="absolute top-4 left-4 bg-teal-500 text-white text-xs font-medium py-1 px-3 rounded-lg shadow-md">
                                        <?= htmlspecialchars($row['name']) ?>
                                    </div>
                                </div>

                                <!-- Article Info -->
                                <div class="p-4">
                                    <a href="#"
                                        class="text-gray-800 text-lg font-semibold hover:text-teal-500 transition-colors duration-200 block">
                                        <?= htmlspecialchars($row['name']) ?>
                                    </a>
                                    <p class="text-gray-600 text-sm mt-2 flex items-center">
                                        <i class="fa fa-calendar-alt text-teal-500 mr-2"></i>
                                        <?= htmlspecialchars($row['created_Date']) ?>
                                    </p>
                                    <div class="text-gray-500 text-sm mt-3">
                                        <p class="line-clamp-3">
                                            <?= htmlspecialchars($row['description']) ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="flex justify-between items-center p-4 border-t border-gray-200 bg-gray-50">
                                    <a href="./artecl.php?id=<?= $row['id'] ?>" target="_blank"
                                        class="text-teal-500 hover:text-teal-700 text-sm font-semibold hover:underline transition-all duration-300">
                                        Lire la suite
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endforeach
        ?>

        <!-- Sidebar -->
        <aside class="lg:col-span-1">
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h3 class="text-lg font-bold mb-4">Categories</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Electric Vehicles</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Sports Cars</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Luxury</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">SUVs</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600">Reviews</a></li>
                </ul>
            </div>

            <!-- Tags -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-bold mb-4">Popular Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-blue-100 hover:text-blue-600">Tesla</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-blue-100 hover:text-blue-600">BMW</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-blue-100 hover:text-blue-600">Electric</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-blue-100 hover:text-blue-600">Hybrid</a>
                    <a href="#" class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-blue-100 hover:text-blue-600">Performance</a>
                </div>
            </div>
        </aside>
    </div>
</main>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Contact Us</h4>
                    <p class="text-gray-300">Email: contact@carblog.com</p>
                    <p class="text-gray-300">Phone: (555) 123-4567</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.95,4.57a10,10,0,0,1-2.82.77,4.96,4.96,0,0,0,2.16-2.72,9.9,9.9,0,0,1-3.12,1.19,4.92,4.92,0,0,0-8.39,4.49A14,14,0,0,1,1.64,3.16,4.92,4.92,0,0,0,3.2,9.72,4.86,4.86,0,0,1,.96,9.11v.06a4.93,4.93,0,0,0,3.95,4.83,4.86,4.86,0,0,1-2.22.08,4.93,4.93,0,0,0,4.6,3.42A9.87,9.87,0,0,1,0,19.54,13.94,13.94,0,0,0,7.55,22a13.89,13.89,0,0,0,14-13.95q0-.32-.01-.63A10,10,0,0,0,23.95,4.57Z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.69,4.77-4.92,4.92-1.27.06-1.65.07-4.85.07s-3.58,0-4.85-.07c-3.25-.15-4.77-1.69-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.92,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.35.2-6.78,2.62-7,7C0,8.33,0,8.74,0,12S0,15.67.07,16.95c.2,4.36,2.62,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.35-.2,6.78-2.62,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.35-2.62-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>© 2025 CarBlog. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>