<?php
/**
 * Created by PhpStorm.
 * User: schueler
 * Date: 25.07.2017
 * Time: 09:40
 */

function redirectToLogin(){
    $rootURL = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    header("Location: ".$rootURL."login.php");
    exit();
}