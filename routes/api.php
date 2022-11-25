<?php

use Src\Route;

Route::add("GET", '/products', [\Controller\ProductController::class, "showProducts"]);
Route::add("GET", '/signup', [\Controller\UserController::class, "registration"]);
Route::add("GET", '/login', [\Controller\UserController::class, "authorization"]);