<?php
/**
 * Created by PhpStorm.
 * User: DLI
 * Date: 27.07.2017
 * Time: 12:54
 */
require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if (false) {

    if (false) {
        $attrArray = array();
        $attrArray[] = array(3, "535254");
        $attrArray[] = array(2, "4GB");
        $attrArray[] = array(1, "Intel Pentium");
        $attrArray[] = array(4, "500GB");
        $attrArray[] = array(5, "SSD");
        $attrArray[] = array(6, "HDMI");

        $typeId = 1;
        $roomId = 0;
        $buyingDate = null;
        $vendorId = 1;
        $name = "MultiPC";
        $manufactorId = 1;
        $bez = "schlaue Bezeichnung";
        $warranty = 345464;
        $note = "schlauer Kommentar";
        $amount = 5;
        insertHardware($typeId, $vendorId, $roomId, $name, $manufactorId, $bez, $buyingDate, $warranty, $note, $amount, $attrArray);
    } else {
        $name = "";
        $bez = "";
        $buyingDate = null;
        $licenceTime = 0;
        $note = "";
        $manufactor = "";
        $verNum = "";
        $licenceType = 0;
        $amount = 0;
        $licenceInfo = "";
        $installHint = "";

        insertSoftware($name, $bez, $buyingDate, $licenceTime, $note, $manufactor, $verNum, $licenceType, $amount, $licenceInfo, $installHint);
    }
}