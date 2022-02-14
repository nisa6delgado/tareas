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
$route->get('/', [Home::class, 'index']);

// Configurations
$route->get('/configurations', [Configurations::class, 'edit']);
$route->post('/configurations', [Configurations::class, 'update']);

// Projects
$route->get('/projects/create', [Projects::class, 'create']);
$route->post('/projects/store', [Projects::class, 'store']);
$route->post('/projects/update', [Projects::class, 'update']);

$route->get('/projects/show/{slug}', [Projects::class, 'show']);
$route->get('/projects/edit/{slug}', [Projects::class, 'edit']);
$route->get('/projects/delete/{slug}', [Projects::class, 'delete']);

// Tasks
$route->get('/tasks/create/{slug}', [Tasks::class, 'create']);
$route->post('/tasks/store', [Tasks::class, 'store']);

$route->get('/tasks/show/{slug}/{id}', [Tasks::class, 'show']);

$route->get('/tasks/edit/{slug}/{id}', [Tasks::class, 'edit']);
$route->post('/tasks/update', [Tasks::class, 'update']);

$route->get('/tasks/delete/{slug}/{id}', [Tasks::class, 'delete']);

// Status
$route->get('/status/{id_task}/{status}', [Status::class, 'update']);

// Files
$route->get('/files/delete/{id}', [Files::class, 'delete']);

// Backup
$route->get('/backup', [Backups::class, 'generate']);
