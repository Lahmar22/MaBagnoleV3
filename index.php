<?php

require_once __DIR__ . '/app/Controllers/controllePage.php';

$url = $_SERVER['REQUEST_URI'];
$path = explode('/', trim($url, '/'));

$route = $path[1];

$routes = [
    '' => 'app/Views/home.php',
    'login' => 'app/Views/login.php',
    'inscription' => 'app/Views/register.php',
    'home' => 'app/Controllers/ControllerLogin.php',
    'accueil' => 'app/Views/client/home.php',
    'vehicule' => 'app/Views/client/vehicule.php',
    'reservationVehicule' => 'app/Controllers/reservationVehicule.php',
    'reservation' => 'app/Views/client/reservation.php',
    'reservationAdmin' => 'app/Views/admin/reservation.php',
    'homeAdmin' => 'app/Views/admin/home.php',
    'updateStatutReserv' => 'app/Controllers/updateStatutReserv.php',
    'ajouterVehicule' => 'app/Controllers/ajouterVehicule.php',
    'ajouterCategorie' => 'app/Controllers/ajouterCategorie.php',
    'modifierVehicule' => 'app/Controllers/modifierVehicule.php',
    'supprimerVehicule' => 'app/Controllers/supprimerVehicule.php',
    'anuulerReservation' => 'app/Controllers/anuulerReservation.php',
    'logout' => 'app/Controllers/logout.php',
];

if (array_key_exists($route, $routes)) {
    routerPage($routes[$route]) ;
} else {
    require 'app/Views/error.php';
}
