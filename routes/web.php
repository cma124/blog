<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

// Home
Route::get('/', [ArticleController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);

// My Articles
Route::get('/articles/my_articles', [ArticleController::class, 'myArticles']);

// Detail Article
Route::get('/articles/detail/{id}', [ArticleController::class, 'detail']);

// Add Article Form
Route::get('/articles/add', [ArticleController::class, 'add']);

// Create Article
Route::post('/articles/add', [ArticleController::class, 'create']);

// Edit Article Form
Route::get('/articles/edit/{id}', [ArticleController::class, 'edit']);

// Update Article
Route::post('/articles/edit/{id}', [ArticleController::class, 'update']);

// Delete Article
Route::get('/articles/delete/{id}', [ArticleController::class, 'delete']);

// Create Comment
Route::post('/comments/add', [CommentController::class, 'create']);

// Delete Comment
Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);

Auth::routes();

// Package Default Route for Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
