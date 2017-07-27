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
$user = "root";
$pass = "";
$ip = "localhost";

// Datenbank Informationen fuer die Nutzer Datenbank
$db_userDatabase = "nutzer";
$user_userDatabase = "root";
$pass_userDatabase = "";
$ip_userDatabase = "localhost";