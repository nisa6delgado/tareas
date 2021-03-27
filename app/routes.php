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

$route->auth();

// Layout
$route->get('/', 'Layouts@index');

// Dashboard
$route->get('/dashboard', 'Dashboard@index');

// Projects
$route->get('/projects/{slug}', 'Projects@index');
$route->post('/projects/store', 'Projects@store');
$route->post('/projects/update', 'Projects@update');
$route->get('/projects/delete/{id}', 'Projects@delete');

// Tasks
$route->post('/tasks/store', 'Tasks@store');
$route->post('/tasks/status', 'Tasks@status');
$route->post('/tasks/update', 'Tasks@update');
$route->post('/tasks/move', 'Tasks@move');
$route->get('/tasks/delete/{id}', 'Tasks@delete');

// Comments
$route->post('/comments/store', 'Comments@store');
$route->get('/comments/delete/{id}', 'Comments@delete');

// Files
$route->post('/files/store', 'Files@store');
$route->get('/files/delete/{id}', 'Files@delete');

// Users
$route->get('/users', 'Users@index');
$route->get('/users/create', 'Users@create');
$route->post('/users/store', 'Users@store');
$route->get('/users/edit/{id}', 'Users@edit');
$route->post('/users/update', 'Users@update');
$route->get('/users/delete/{id}', 'Users@delete');

// Code
$route->get('/code/{file}', 'Codes@view');

// Crons
$route->get('/crons/clear', 'Crons@clear');
