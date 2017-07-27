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
    $_SESSION['VerwaltungAttributesType'] = "1";
}
if(isset($_POST['dropdownValue'])) {
    $_SESSION['VerwaltungAttributesType'] = $_POST['dropdownValue'];
}

$htmlstring = "";

if($_SESSION['VerwaltungAttributesType'] == "-1") {
    //Auslesen aller vorhandenen Software-Typen für die Input-Felder
    $array = array("Lizenzlaufzeit", "Versionsnummer", "Lizenztyp", "Anzahl", "Lizenzinformationen", "Installationshinweis");

    foreach($array as $value)
    {
        $htmlstring = $htmlstring."<div class=\"form-group\">";
        $htmlstring = $htmlstring."<label for=\"".$value."\">".$value.":</label>";
        $htmlstring = $htmlstring."<input type=\"text\" class=\"form-control\" id=\"".$value."\" name=\"".$value."\">";
        $htmlstring = $htmlstring."</div>";
    }
}else{
    //Auslesen aller vorhandenen Hardware-Typen für die Input-Felder
    $result = getHardwareAttributesByTypeID($_SESSION['VerwaltungAttributesType']);

    foreach($result as $array)
    {
        foreach($array as $value)
        {
            $htmlstring = $htmlstring."<div class=\"form-group\">";
            $htmlstring = $htmlstring."<label for=\"".$value."\">".$value.":</label>";
            $htmlstring = $htmlstring."<input type=\"text\" class=\"form-control\" id=\"".$value."\" name=\"".$value."\">";
            $htmlstring = $htmlstring."</div>";
        }
    }
}

echo $htmlstring;