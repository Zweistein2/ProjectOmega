<?php
// * Created by PhpStorm.
// * Author: Fabian Karolat
// * Date: 24.07.2017
// * Time: 9:24

require_once "config.php";

$connection = mysqli_connect($ip, $user, $pass, $db);
$connection_userDatabase = mysqli_connect($ip_userDatabase, $user_userDatabase, $pass_userDatabase, $db_userDatabase);
