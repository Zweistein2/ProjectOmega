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
    $root = dirname(__FILE__)."/";
}

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