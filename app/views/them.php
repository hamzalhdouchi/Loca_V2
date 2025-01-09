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

