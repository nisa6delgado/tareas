<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. These
| routes are loaded by the RoutingServiceProvider. Now create something great!
|
*/

// Home
$route->auth();

// Home
$route->get('/', [HomeController::class, 'index']);

// Configuration
$route->get('/configurations', [ConfigurationController::class, 'edit']);
$route->post('/configurations', [ConfigurationController::class, 'update']);

// Project
$route->get('/projects/create', [ProjectController::class, 'create']);
$route->post('/projects/store', [ProjectController::class, 'store']);
$route->post('/projects/update', [ProjectController::class, 'update']);

$route->get('/projects/show/{slug}', [ProjectController::class, 'show']);
$route->get('/projects/edit/{slug}', [ProjectController::class, 'edit']);
$route->get('/projects/delete/{slug}', [ProjectController::class, 'delete']);

// Task
$route->get('/tasks/create/{slug}', [TaskController::class, 'create']);
$route->post('/tasks/store', [TaskController::class, 'store']);

$route->get('/tasks/show/{slug}/{id}', [TaskController::class, 'show']);

$route->get('/tasks/edit/{slug}/{id}', [TaskController::class, 'edit']);
$route->post('/tasks/update', [TaskController::class, 'update']);

$route->get('/tasks/delete/{slug}/{id}', [TaskController::class, 'delete']);

$route->post('/tasks/move', [MoveController::class, 'update']);

// File
$route->get('/files/show/{id}', [FileController::class, 'show']);
$route->get('/files/delete/{id}', [FileController::class, 'delete']);

// Backup
$route->get('/backup', [BackupController::class, 'index']);
