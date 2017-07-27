<?php
/**
 * Created by PhpStorm.
 * User: DLI
 * Date: 27.07.2017
 * Time: 12:54
 */
require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if(isset($_POST['Type']))
{
    $attrArray = array();

    if($_POST['isHardware']) {
        $typeId = $_POST['Type'];
        $amount = $_POST['Amount'];
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
                case "isHardware":
                    break;
                case "Hersteller":
                    $manufactorId = $value;
                    break;
                case "Einkaufsdatum":
                    $buyingDate = $value;
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

        //TODO: VendorID und RoomID herausbekommen.
        
        //insertHardware($typeId, $vendorId, $roomId, $name, $manufactorId, $bez, $buyingDate, $warranty, $note, $amount, $attrArray);
    }else{

    }
}

if(false) {

    if (false) {

    } else {

        $name = "Word";
        $bez = "Microsoft Word";
        $buyingDate = null;
        $licenceTime = 0;
        $note = "Word";
        $manufactor = "Microsoft";
        $verNum = "5353";
        $licenceType = 0;
        $amount = 12;
        $licenceInfo = "Volumen Lizenz mit 12 Lizenzen";
        $installHint = "Farg den Admin deines Vertrauens";
        $roomId = 2;

        insertSoftware($name, $bez, $buyingDate, $licenceTime, $note, $manufactor, $verNum, $licenceType, $amount, $licenceInfo, $installHint, $roomId);
    }
}