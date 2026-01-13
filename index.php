<?php 
$url = $_SERVER['REQUEST_URI'];

$path = explode('/', $url);

if($path[2] === ''){
    require 'Views/home.php';   

}elseif($path[2] === 'login'){
    require 'Views/login.php';

}elseif($path[2] === 'inscription'){
    require 'Views/register.php';
}else{
    require 'Views/error.php';
}
