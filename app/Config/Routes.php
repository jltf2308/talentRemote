<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login y registro 
$routes->get('/login', 'Auth\LoginController::index');
$routes->get('/register/talent', 'Auth\RegisterController::index');
$routes->get('/register/recruiter', 'Auth\RegisterController::index');

// dashboard
$routes->get('/dashboard', 'Dashboard\DashboardController::index',['filter' => 'authGuard']);

// bolsa de trabajo
$routes->get('/jobs', 'Jobs\JobsController::index',['filter' => 'authGuard']);

// perfil
$routes->get('/profile', 'Profile\ProfileController::index',['filter' => 'authGuard']);
$routes->match(['get', 'put'], '/updateProfile', 'Profile\ProfileController::store',['filter' => 'authGuard']);


// Login and register routes
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'Auth\LoginController::loginAuth');
$routes->match(['get', 'post'], 'RegisterController/store', 'Auth\RegisterController::store');

// $routes->get('/profile', 'ProfileController::index',['filter' => 'authGuard']);
