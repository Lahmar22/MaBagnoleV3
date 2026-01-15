<?php 
$url = $_SERVER['REQUEST_URI'];

$path = explode('/', $url);

if($path[2] === ''){
    require 'app/Views/home.php';   

}elseif($path[2] === 'login'){
    require 'app/Views/login.php';

}elseif($path[2] === 'inscription'){
    require 'app/Views/register.php';

}elseif($path[2] === 'home'){
    require 'app/Controllers/ControllerLogin.php';

}elseif($path[2] === 'accueil'){
    require 'app/Views/client/home.php';

}elseif($path[2] === 'vehicule'){
    require 'app/Views/client/vehicule.php';

}elseif($path[2] === 'reservationVehicule'){
    require 'app/Controllers/reservationVehicule.php';
}
elseif($path[2] === 'reservation'){
    require 'app/Views/client/reservation.php';

}
elseif($path[2] === 'anuulerReservation'){
    require 'app/Controllers/anuulerReservation.php';

}
elseif($path[2] === 'logout'){
    require 'app/Controllers/logout.php';

}
else{
    require 'app/Views/error.php';
}
