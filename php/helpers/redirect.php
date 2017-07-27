<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 25.07.2017
 * Time: 09:40
 */

require_once("../database/config.php");

if($environment == "local") {
    $root = "http://localhost/ProjectOmega/php/pages/";
}else{
    $root = $_SERVER['SERVER_ADDR']."/php/pages/";
}

function redirectToLogin(){
    global $root;
    global $environment;
    if($environment == "local") {
        header("Location: ".$root."login.php");
    }else{
        header("Location: "."login.php");
    }
    exit();
}

function redirectTo($page){
    global $root;
    global $environment;
    if($environment == "local") {
        header("Location: ".$root.$page);
    }else{
        header("Location: ".$page);
    }
    exit();
}