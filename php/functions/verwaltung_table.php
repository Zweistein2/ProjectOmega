<?php

session_start();

require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if (!isset($_SESSION['VerwaltungTableType'])) {
    $_SESSION['VerwaltungTableType'] = "PC";
}
if (isset($_POST['dropdownValue'])) {
    $_SESSION['VerwaltungTableType'] = $_POST['dropdownValue'];
}

$result = getHardwareByType($_SESSION['VerwaltungTableType']);
$viewModel = array();
foreach ($result as $array) {
    $viewModel[] = $array;
}
$js_array = json_encode($viewModel);
$js_array = "{\"data\": " . $js_array;
$js_array = $js_array . "}";
echo $js_array;