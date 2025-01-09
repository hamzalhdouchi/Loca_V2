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
