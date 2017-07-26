<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 25.07.2017
 * Time: 09:40
 */

function redirectToLogin(){
    $rootURL = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    header("Location: ".$rootURL."pages/login.php");
    exit();
}

function redirectTo($page){
    $rootURL = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/pages/'.$page;
    header("Location: ".$rootURL);
    exit();
}