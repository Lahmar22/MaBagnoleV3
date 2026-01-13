<?php 
$url = $_SERVER['REQUEST_URI'];

$path = explode('/', $url);

if($path[2] === ''){
    require 'app/Views/home.php';   

}elseif($path[2] === 'login'){
    require 'app/Views/login.php';

}elseif($path[2] === 'inscription'){
    require 'app/Views/register.php';
}else{
    require 'app/Views/error.php';
}
