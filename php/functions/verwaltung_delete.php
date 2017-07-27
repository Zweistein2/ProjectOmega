<?php

require_once('../database/verwaltung_sql.php');
require_once('../database/database.php');

if (isset($_POST['ids'])) {
    $ids = explode(',', $_POST['ids']);

    foreach ($ids as $id) {
        $result = deleteRowByHardwareID(trim($id, "\""));
        echo $result;
    }
}