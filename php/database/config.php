<?php
// * Created by PhpStorm.
// * Author: Fabian Karolat
// * Date: 24.07.2017
// * Time: 9:53

require_once("../helpers/cryption.php");

// Unterschied zwischen Local und Server fuer Redirct noetig.
$environment = "local";

// Datenbank Informationen fuer die Verwaltungs Datenbank.
$db = "softwareTest";
$user = "dev";
$pass = "dev";
$ip = "192.168.20.1";

// Datenbank Informationen fuer die Nutzer Datenbank
$db_userDatabase = "nutzer";
$user_userDatabase = "dev";
$pass_userDatabase = "dev";
$ip_userDatabase = "192.168.20.1";