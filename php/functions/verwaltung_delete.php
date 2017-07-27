<?php
/**
 * Created by PhpStorm.
 * User: Fabian Karolat
 * Date: 26.07.2017
 * Time: 12:43
 */

require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if (isset($_POST['ids'])) {
    $ids = explode(',', $_POST['ids']);

    foreach ($ids as $id) {
        $result = deleteRowByHardwareID(trim($id, "\""));
        echo $result;
    }
}