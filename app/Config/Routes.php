<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Dashboard\DashboardController::index',['filter' => 'authGuard']);
// Login and register routes
$routes->get('/login', 'Auth\LoginController::index');
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'Auth\LoginController::loginAuth');
$routes->match(['get', 'post'], 'RegisterController/store', 'Auth\RegisterController::store');
$routes->get('/register/talent', 'Auth\RegisterController::index');
$routes->get('/register/recruiter', 'Auth\RegisterController::index');
// $routes->get('/profile', 'ProfileController::index',['filter' => 'authGuard']);
