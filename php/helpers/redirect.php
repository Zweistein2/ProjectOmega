<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf, Fabian Karolat
 * Date: 25.07.2017
 * Time: 09:40
 */

require_once("../database/config.php");

/**
 *  Ueberprueft wo die Anwendung sich befindet.
 *  Wird benoetig fuer Seitenweiterleitung.
 */
if($environment == "local") {
    $root = "http://localhost/ProjectOmega/php/pages/";
}else{
    $root = $_SERVER['SERVER_ADDR']."/php/pages/";
}


/**
 * Leitet den Benutzer auf die Login Seite weiter.
 *
 */
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


/**
 * Leitet den Benutzer auf eine bestimmte Seite weiter.
 *
 * @param $page
 */
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