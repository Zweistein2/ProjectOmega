<?php
/**
 * Created by PhpStorm.
 * User: Fabian Karolat
 * Date: 27.07.2017
 * Time: 12:54
 */
require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if(isset($_POST['Type']))
{
    $attrArray = array();

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
                if(!is_numeric($key))
                {
                    $attrArray[] = array(getHardwareattributeIDForBezeichner($key)[0][0], $value);
                }
                break;
        }
    }

    for($i = 1; $i <= $amount; $i++)
    {
        $attrArray[99] = array("3", $_POST[$i]);

        insertHardware($typeId, $vendorId, $roomId, $name, $manufactorId, $bez, $buyingDate, $warranty, $note, $attrArray);
    }

}