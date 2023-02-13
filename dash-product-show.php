<?php
require_once('config.php');

if ($_SESSION['user']['role_id'] != 1) {
    header('Location: index.php');
};
$admin = $_SESSION['user'];

// Product
$product = Product::show($_GET['id']);


// Images

$images = Images::index($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_img'])) {


    $extra = count($images);

    $imgName = $_FILES['url']['name'];
    $tmp_name = $_FILES['url']['tmp_name'];
    $folder = __DIR__ . "/media/" . $extra . $imgName;
    move_uploaded_file($tmp_name, $folder);

    if ($imgName !== '') {
        $main_img = "media/" . $extra . $imgName;
    } else {
        $main_img = '';
    }

    Images::create($_GET['id'], $main_img);
}




if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['delete_id'])) {
    $delete = Images::delete($_POST['delete_id'], $_GET['id']);
}

// color

$colorss = Colors::index($_GET['id']);
$colors = Color::index();


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['select_color'])) {
    Colors::create($_GET['id'], $_POST['color_name']);
}


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['delete_c_id'])) {
    $delete = Colors::delete($_POST['delete_c_id'], $_GET['id']);
}

// size

$sizes = Sizes::index($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save_size'])) {
    Sizes::create($_GET['id'], $_POST['size']);
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['delete_s_id'])) {
    $delete = Sizes::delete($_POST['delete_s_id'], $_GET['id']);
}
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#0ed3cf">
    <meta name="msapplication-TileColor" content="#0ed3cf">
    <meta name="theme-color" content="#0ed3cf">

    <meta property="og:image" content="http://tailwindcomponents.com/storage/7395/conversions/temp60492-ogimage.jpg?v=2023-01-18 05:33:11" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="640" />
    <meta property="og:image:type" content="image/png" />

    <meta property="og:url" content="https://tailwindcomponents.com/component/admin-dashboard-along-with-dark-mode-responsive-sidebar-7/landing" />
    <meta property="og:title" content="Tailwind CSS Admin Dashboard - Dark/Light Mode by jer-myah" />
    <meta property="og:description" content="Admin template with responsive sidebar along with several responsive components. It has both light &amp; dark mode." />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@TwComponents" />
    <meta name="twitter:title" content="Tailwind CSS Admin Dashboard - Dark/Light Mode by jer-myah" />
    <meta name="twitter:description" content="Admin template with responsive sidebar along with several responsive components. It has both light &amp; dark mode." />
    <meta name="twitter:image" content="http://tailwindcomponents.com/storage/7395/conversions/temp60492-ogimage.jpg?v=2023-01-18 05:33:11" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">


    <title>Tailwind CSS Admin Dashboard - Dark/Light Mode by jer-myah. </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">
    <style>
        /* Compiled dark classes from Tailwind */
        .dark .dark\:divide-gray-700> :not([hidden])~ :not([hidden]) {
            border-color: rgba(55, 65, 81);
        }

        .dark .dark\:bg-gray-50 {
            background-color: rgba(249, 250, 251);
        }

        .dark .dark\:bg-gray-100 {
            background-color: rgba(243, 244, 246);
        }

        .dark .dark\:bg-gray-600 {
            background-color: rgba(75, 85, 99);
        }

        .dark .dark\:bg-gray-700 {
            background-color: rgba(55, 65, 81);
        }

        .dark .dark\:bg-gray-800 {
            background-color: rgba(31, 41, 55);
        }

        .dark .dark\:bg-gray-900 {
            background-color: rgba(17, 24, 39);
        }

        .dark .dark\:bg-red-700 {
            background-color: rgba(185, 28, 28);
        }

        .dark .dark\:bg-green-700 {
            background-color: rgba(4, 120, 87);
        }

        .dark .dark\:hover\:bg-gray-200:hover {
            background-color: rgba(229, 231, 235);
        }

        .dark .dark\:hover\:bg-gray-600:hover {
            background-color: rgba(75, 85, 99);
        }

        .dark .dark\:hover\:bg-gray-700:hover {
            background-color: rgba(55, 65, 81);
        }

        .dark .dark\:hover\:bg-gray-900:hover {
            background-color: rgba(17, 24, 39);
        }

        .dark .dark\:border-gray-100 {
            border-color: rgba(243, 244, 246);
        }

        .dark .dark\:border-gray-400 {
            border-color: rgba(156, 163, 175);
        }

        .dark .dark\:border-gray-500 {
            border-color: rgba(107, 114, 128);
        }

        .dark .dark\:border-gray-600 {
            border-color: rgba(75, 85, 99);
        }

        .dark .dark\:border-gray-700 {
            border-color: rgba(55, 65, 81);
        }

        .dark .dark\:border-gray-900 {
            border-color: rgba(17, 24, 39);
        }

        .dark .dark\:hover\:border-gray-800:hover {
            border-color: rgba(31, 41, 55);
        }

        .dark .dark\:text-white {
            color: rgba(255, 255, 255);
        }

        .dark .dark\:text-gray-50 {
            color: rgba(249, 250, 251);
        }

        .dark .dark\:text-gray-100 {
            color: rgba(243, 244, 246);
        }

        .dark .dark\:text-gray-200 {
            color: rgba(229, 231, 235);
        }

        .dark .dark\:text-gray-400 {
            color: rgba(156, 163, 175);
        }

        .dark .dark\:text-gray-500 {
            color: rgba(107, 114, 128);
        }

        .dark .dark\:text-gray-700 {
            color: rgba(55, 65, 81);
        }

        .dark .dark\:text-gray-800 {
            color: rgba(31, 41, 55);
        }

        .dark .dark\:text-red-100 {
            color: rgba(254, 226, 226);
        }

        .dark .dark\:text-green-100 {
            color: rgba(209, 250, 229);
        }

        .dark .dark\:text-blue-400 {
            color: rgba(96, 165, 250);
        }

        .dark .group:hover .dark\:group-hover\:text-gray-500 {
            color: rgba(107, 114, 128);
        }

        .dark .group:focus .dark\:group-focus\:text-gray-700 {
            color: rgba(55, 65, 81);
        }

        .dark .dark\:hover\:text-gray-100:hover {
            color: rgba(243, 244, 246);
        }

        .dark .dark\:hover\:text-blue-500:hover {
            color: rgba(59, 130, 246);
        }

        /* Custom style */
        .header-right {
            width: calc(100% - 3.5rem);
        }

        .sidebar:hover {
            width: 16rem;
        }

        @media only screen and (min-width: 768px) {
            .header-right {
                width: calc(100% - 16rem);
            }
        }
    </style>
    <div x-data="setup()" :class="{ 'dark': isDark }">
        <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

            <!-- Header -->
            <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
                <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-blue-800 dark:bg-gray-800 border-none">
                    <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg" />
                    <span class="hidden md:block"><?= $admin['name'] ?></span>
                </div>
                <div class="flex justify-between items-center h-14 bg-blue-800 dark:bg-gray-800 header-right">
                    <div class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200">
                        <button class="outline-none focus:outline-none">
                            <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <input type="search" name="" id="" placeholder="Search" class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
                    </div>
                    <ul class="flex items-center">
                        <li>
                            <button aria-hidden="true" @click="toggleTheme" class="group p-2 transition-colors duration-200 rounded-full shadow-md bg-blue-200 hover:bg-blue-200 dark:bg-gray-50 dark:hover:bg-gray-200 text-gray-900 focus:outline-none">
                                <svg x-show="isDark" width="24" height="24" class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <svg x-show="!isDark" width="24" height="24" class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                            </button>
                        </li>
                        <li>
                            <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700"></div>
                        </li>
                        <li>
                            <a href="./logout.php" class="flex items-center mr-4 hover:text-blue-100">
                                <span class="inline-flex mr-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ./Header -->

            <!-- Sidebar -->
            <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-blue-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
                <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
                    <ul class="flex flex-col py-4 space-y-1">
                        <li class="px-5 hidden md:block">
                            <div class="flex flex-row items-center h-8">
                                <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Main</div>
                            </div>
                        </li>
                        <li>
                            <a href="./dashboard.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="./countries.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Countries</span>
                            </a>
                        </li>
                        <li>
                            <a href="./dash-category.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="./dash-product.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="./dash-color.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Colors</span>
                            </a>
                        </li>
                        <li class="px-5 hidden md:block">
                            <div class="flex flex-row items-center mt-5 h-8">
                                <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Settings</div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Settings</span>
                            </a>
                        </li>
                    </ul>
                    <p class="mb-14 px-5 py-3 hidden md:block text-center text-xs">Copyright @2021</p>
                </div>
            </div>
            <!-- ./Sidebar -->

            <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
                <div class="w-full flex items-center justify-between p-3">
                    <h1 class="text-3xl font-bold">Product Show</h1>
                </div>
                <section class="w-full bg-gray-100 pt-10 text-gray-600">
                    <div class="mx-auto mt-10 max-w-6xl flex-wrap justify-center rounded-lg bg-white px-5 py-24">
                        <!-- QR Code Number Account & Uploadfile -->
                        <div class="flex-wrap">
                            <!-- Step Checkout -->
                            <div class="mt-8 max-w-sm md:mt-0 md:ml-10 md:w-2/3">
                                <div class="relative flex pb-12">
                                    <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                    </div>
                                    <div class="relative  inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">NAME:</h2>
                                        <p class="font-laonoto text-xl leading-relaxed">
                                            <?= $product['name'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative flex pb-12">
                                    <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                    </div>
                                    <div class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        $
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">Price:</h2>
                                        <p class="font-laonoto text-xl leading-relaxed">$<?= $product['price'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative flex pb-12">
                                    <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                    </div>
                                    <div class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-red-900 font-extrabold">
                                        -$
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">Discount:</h2>
                                        <p class="font-laonoto text-xl leading-relaxed">$<?= $product['discount'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative flex pb-12">
                                    <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                    </div>
                                    <div class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        =
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">Category:</h2>
                                        <p class="font-laonoto text-xl leading-relaxed"><?= $product['category'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative flex pb-12">
                                    <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                    </div>
                                    <div class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        =_
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">Category_Tag:</h2>
                                        <p class="font-laonoto text-xl leading-relaxed"><?= $product['category_tag'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative flex pb-12">
                                    <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                                        <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                                    </div>
                                    <div class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        { }
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">Count:</h2>
                                        <p class="font-laonoto text-xl leading-relaxed"><?= $product['count'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative flex pb-12">
                                    <div class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                            <circle cx="12" cy="5" r="3"></circle>
                                            <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">Date</h2>
                                        <p class="font-laonoto leading-relaxed"><?= $product['created_at'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="mx-auto">
                                <img class="mx-auto mt-12 rounded-lg border p-2 md:mt-0" style="width: 70%" src="<?= $product['main_img'] ?>" alt="step" />
                                <div>
                                    <h1 class="font-laonoto mt-4 text-center text-xl font-bold">Main Img</h1>
                                </div>
                                <br>
                                <br>
                                <div class="flex gap-10 flex-wrap">
                                    <?php foreach ($images as $image) : ?>
                                        <div class="flex flex-col items-center" style="width: 45%">
                                            <img class="mx-auto mt-12 rounded-lg border p-2 md:mt-0" style="width: 100%" src="<?= $image['url'] ?>" />
                                            <form action="" method="POST" onsubmit="confirm('Really shut up')">
                                                <input type="hidden" name="delete_id" value="<?= $image['id'] ?>">
                                                <button type="submit" class="rounded bg-red-700 text-white p-3 mt-10">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <br>
                                <br>
                                <!-- component -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mx-auto w-52">
                                        <div class="m-4">
                                            <div class="flex w-full items-center justify-center">
                                                <label class="flex h-14 w-full cursor-pointer flex-col border-4 border-dashed border-gray-200 hover:border-gray-300 hover:bg-gray-100">
                                                    <div class="mt-4 flex items-center justify-center space-x-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-400">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                        </svg>

                                                        <p class="font-laonoto text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Upload Img</p>
                                                    </div>
                                                    <input type="file" name="url" class="opacity-0" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="add_img" name="add_img" class="mx-auto block rounded-md border bg-blue-500 px-6 py-2 text-white outline-none">upload</button>
                                </form>
                            </div>
                            <div class="mx-auto flex flex-wrap gap-10">
                                <?php foreach ($colorss as $c) : ?>
                                    <div class="flex flex-col items-start justify-center">
                                        <div class="w-[60px] h-[60px] mt-5 border" style="background-color: <?= $c['color_name']; ?>; display: flex; align-items: center; justify-content: center; color: #ccc;"><?= $c['color_name']; ?></div>
                                        <form action="" method="POST" onsubmit="confirm('Really shut up')">
                                            <input type="hidden" name="delete_c_id" value="<?= $c['id'] ?>">
                                            <button type="submit" class="rounded bg-red-700 text-white p-3 mt-10">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="mx-auto mt-10">
                                <form action="" method="POST" class="flex flex-col items-center">
                                    <select name="color_name" id="" class="w-[100px] flex border mb-10">
                                        <?php foreach ($colors as $color) : ?>
                                            <option value="<?= $color['color_name'] ?>"><?= $color['color_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="select_color" class="mx-auto block rounded-md border bg-blue-500 px-6 py-2 text-white outline-none" name="select_color">Select Color</button>
                                </form>
                            </div>
                            <div class="mx-auto flex flex-wrap gap-10">
                                <?php foreach ($sizes as $size) : ?>
                                    <div class="flex flex-col items-start justify-center">
                                        <div class="w-[60px] h-[60px] mt-5 border" style="display: flex; align-items: center; justify-content: center; color: #ccc;"><?= $size['size']; ?></div>
                                        <form action="" method="POST" onsubmit="confirm('Really shut up')">
                                            <input type="hidden" name="delete_s_id" value="<?= $size['id'] ?>">
                                            <button type="submit" class="rounded bg-red-700 text-white p-3 mt-10">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="mx-auto mt-10">
                                <form action="" method="POST" class="flex flex-col items-center">
                                    <input type="text" name="size" class="bg-blue-500 text-white">
                                    <button type="save_size" name="save_size" class="mx-auto block mt-6 rounded-md border bg-blue-500 px-6 py-2 text-white outline-none" name="select_color">Add size</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script>
        const setup = () => {
            const getTheme = () => {
                if (window.localStorage.getItem('dark')) {
                    return JSON.parse(window.localStorage.getItem('dark'))
                }
                return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
            }

            const setTheme = (value) => {
                window.localStorage.setItem('dark', value)
            }

            return {
                loading: true,
                isDark: getTheme(),
                toggleTheme() {
                    this.isDark = !this.isDark
                    setTheme(this.isDark)
                },
            }
        }
    </script>
</body>

</html>