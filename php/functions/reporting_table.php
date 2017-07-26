<?php
// * Created by PhpStorm.
// * Author: Fabian Karolat
// * Date: 25.07.2017
// * Time: 13:49

session_start();

require_once('../database/reporting_sql.php');
require_once('../database/database.php');

if(!isset($_SESSION['ReportingTableType'])) {
    $_SESSION['ReportingTableType'] = "PC";
    $_SESSION['ReportingTableRoom'] = "001";
}
if(isset($_POST['dropdownValue'])) {
    $_SESSION['ReportingTableType'] = $_POST['dropdownValue'];
}
if(isset($_POST['roomNumber'])) {
    $_SESSION['ReportingTableRoom'] = $_POST['roomNumber'];
}

if($_SESSION['ReportingTableType'] == "Raum")
{
    $result = getComponentsByRoomNumber($_SESSION['ReportingTableRoom']);
    $viewModel = array();
    foreach ($result as $array) {
        $viewModel[] = $array;
    }
    $js_array = json_encode($viewModel);
    $js_array = "{\"data\": ".$js_array;
    $js_array = $js_array."}";
    echo $js_array;
}else
{
    $result = getRoomsByComponentType($_SESSION['ReportingTableType']);
    $viewModel = array();
    foreach ($result as $array) {
        $viewModel[] = $array;
    }
    $js_array = json_encode($viewModel);
    $js_array = "{\"data\": ".$js_array;
    $js_array = $js_array."}";
    echo $js_array;
}