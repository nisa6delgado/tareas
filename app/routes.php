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
$route->get('/', 'Home@index');

// Configurations
$route->get('/configurations', 'Configurations@edit');
$route->post('/configurations', 'Configurations@update');

// Projects
$route->get('/projects/create', 'Projects@create');
$route->post('/projects/store', 'Projects@store');
$route->post('/projects/update', 'Projects@update');

$route->get('/projects/show/{slug}', 'Projects@show');
$route->get('/projects/edit/{slug}', 'Projects@edit');
$route->get('/projects/delete/{slug}', 'Projects@delete');

// Tasks
$route->get('/tasks/create/{slug}', 'Tasks@create');
$route->post('/tasks/store', 'Tasks@store');

$route->get('/tasks/show/{slug}/{id}', 'Tasks@show');

$route->get('/tasks/edit/{slug}/{id}', 'Tasks@edit');
$route->post('/tasks/update', 'Tasks@update');

$route->get('/tasks/delete/{slug}/{id}', 'Tasks@delete');

// Status
$route->get('/status/{id_task}/{status}', 'Status@update');

// Files
$route->get('/files/delete/{id}', 'Files@delete');
