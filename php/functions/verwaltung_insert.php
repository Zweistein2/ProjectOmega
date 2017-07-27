<?php
/**
 * Created by PhpStorm.
 * User: Daniel Linz, Fabian Karolat
 * Date: 27.07.2017
 * Time: 12:54
 */
require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if(isset($_POST['Type']))
{
    $attrArray = array();

    if($_POST['Type'] != "-1") {
        $typeId = $_POST['Type'];
        $manufactorId = "";
        $buyingDate = "";
        $name = "";
        $bez = "";
        $roomId = "";
        $warranty = "";
        $vendorId = "";
        $note = "";

        foreach($_POST as $key => $value) {
            switch($key) {
                case "Amount":
                    break;
                case "Type":
                    break;
                case "Hersteller":
                    $manufactorId = $value;
                    break;
                case "Einkaufsdatum":
                    $buyingDate = "'".$value."'";
                    break;
                case "Name":
                    $name = $value;
                    break;
                case "Bezeichnung":
                    $bez = $value;
                    break;
                case "Raum":
                    $roomId = $value;
                    break;
                case "Warranty":
                    $warranty = $value;
                    break;
                case "Lieferant":
                    $vendorId = $value;
                    break;
                case "Notiz":
                    $note = $value;
                    break;
                default:
                    $attrArray[] = array(getHardwareattributeIDForBezeichner($key)[0][0], $value);
                    break;
            }
        }

        insertHardware($typeId, $vendorId, $roomId, $name, $manufactorId, $bez, $buyingDate, $warranty, $note, $attrArray);
    }else{
        $name = "";
        $bez = "";
        $buyingDate = null;
        $licenceTime = "";
        $note = "";
        $manufactor = "";
        $verNum = "";
        $licenceType = "";
        $amount = "";
        $licenceInfo = "";
        $installHint = "";
        $roomId = "";

        foreach($_POST as $key => $value) {
            switch($key) {
                case "Amount":
                    break;
                case "Type":
                    break;
                case "Hersteller":
                    $manufactor = $value;
                    break;
                case "Einkaufsdatum":
                    $buyingDate =$value;
                    break;
                case "Name":
                    $name = $value;
                    break;
                case "Bezeichnung":
                    $bez = $value;
                    break;
                case "Raum":
                    $roomId = $value;
                    break;
                case "Notiz":
                    $note = $value;
                    break;
                case "Lizenzlaufzeit":
                    $licenceTime = $value;
                    break;
                case "Versionsnummer":
                    $verNum = $value;
                    break;
                case "Lizenztyp":
                    $licenceType = "'".$value."'";
                    break;
                case "Anzahl":
                    $amount = $value;
                    break;
                case "Lizenzinformationen":
                    $licenceInfo = $value;
                    break;
                case "Installationshinweis":
                    $installHint = $value;
                    break;
                default:
                    break;
            }
        }

        insertSoftware($name, $bez, $buyingDate, $licenceTime, $note, $manufactor, $verNum, $licenceType, $amount, $licenceInfo, $installHint, $roomId);
    }
}