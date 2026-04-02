<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController; // Add this

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit'); // Add this route

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Chatbot routes
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::post('/chatbot/clear', [ChatbotController::class, 'clearChat'])->name('chatbot.clear');
Route::get('/chatbot/history', [ChatbotController::class, 'getChatHistory'])->name('chatbot.history');
Route::delete('/chatbot/message/{id}', [ChatbotController::class, 'deleteMessage'])->name('chatbot.delete-message');
Route::get('/chatbot/models', [ChatbotController::class, 'getModels'])->name('chatbot.models');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'viewUsers'])->name('users');
    Route::get('/chat-history', [AdminController::class, 'viewChatHistory'])->name('chat-history');
    Route::get('/settings', [AdminController::class, 'showSettings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('update-settings');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
});