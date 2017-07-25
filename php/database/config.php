<?php

require_once("cryption.php");

$file = "../database/pass.enc";
$db = "";
$user = "";
$pass = decrypt_pass($file, "ingdug");
echo $pass;
$ip = "";