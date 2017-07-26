<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 25.07.2017
 * Time: 09:40
 */

$root = "http://localhost/ProjectOmega/php/pages/"; //$_SERVER['DOCUMENT_ROOT'];

function redirectToLogin(){
    global $root;
    header("Location: ".$root."login.php");
    exit();
}

function redirectTo($page){
    global $root;
    header("Location: ".$root.$page);
    exit();
}