<?php
/**
 * Created by PhpStorm.
 * User: Fabian Karolat
 * Date: 27.07.2017
 * Time: 10:44
 */

session_start();

require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if(!isset($_SESSION['VerwaltungAttributesType'])) {
    $_SESSION['VerwaltungAttributesType'] = "PC";
}
if(isset($_POST['dropdownValue'])) {
    $_SESSION['VerwaltungAttributesType'] = $_POST['dropdownValue'];
}

//Auslesen aller vorhandenen Hardware-Typen für die Input-Felder
$result = getHardwareAttributesByType($_SESSION['VerwaltungAttributesType']);
$htmlstring = "";

foreach($result as $array)
{
    foreach($array as $value)
    {
        $htmlstring = $htmlstring."<div class=\"form-group\">";
        $htmlstring = $htmlstring."<label for=\"".$value."\">".$value.":</label>";
        $htmlstring = $htmlstring."<input type=\"text\" class=\"form-control\" id=\"".$value."\">";
        $htmlstring = $htmlstring."</div>";
    }
}

echo $htmlstring;