<?php

require_once "config.php";

$connection = mysqli_connect($ip, $user, $pass, $db);

$query = "SELECT * FROM X";

$result = mysqli_query($connection, $query);

