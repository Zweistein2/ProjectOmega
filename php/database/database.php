<?php
// * Created by PhpStorm.
// * Author: Fabian Karolat
// * Date: 24.07.2017
// * Time: 9:24

require_once "config.php";

// Datenbank Connection fuer die Verwaltungs Datenbank.
$connection = mysqli_connect($ip, $user, $pass, $db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Datenbank Connection fuer die Nutzer Datenbank.
$connection_userDatabase = mysqli_connect($ip_userDatabase, $user_userDatabase, $pass_userDatabase, $db_userDatabase);
if (!$connection_userDatabase) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fuer den utf-8 codec zusetzten
mysqli_query($connection, "SET NAMES 'utf8'");
mysqli_query($connection_userDatabase, "SET NAMES 'utf8'");