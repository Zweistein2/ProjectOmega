<?php
include_once('database.php');

define("HARDWARE", 'hardware');
define("HARDWARE_ATTRIBUTES", 'hardware_hat_attribute');
define("HARDWARE_KINDS", 'hardwarearten');
define("SUPPLIERS", 'lieferant');
define("ROOMS", 'raeume');
define("ATTRIBUTES", 'hardwareattribute');
define("DESCRIBED", 'wird_beschrieben_durch');

//--hardware
define("H_ID", 'h_id');
define("H_ROOM_ID", 'raeume_r_id');
define("H_SUPPLIER_ID", 'lieferant_l_id');
define("H_STATUS", 'h_status');
define("H_NAME", 'h_name');
define("H_DESC", 'h_bez');
define("H_BUY_DATE", 'h_einkaufsdatum');
define("H_WARRANTY", 'h_gewaehrleistungsdauer');
define("H_NOTE", 'h_notiz');
define("H_DEV", 'h_hersteller');
define("H_ATTR_ID", 'hardwarearten_ha_id');

//--lieferant
define("L_ID", 'l_id');
define("L_COMPANY_NAME", 'l_firmenname');
define("L_STREET", 'l_strasse');
define("L_PLZ", 'l_plz');
define("L_TOWN", 'l_ort');
define("L_TEL", 'l_tel');
define("L_MOBILE", 'l_mobil');
define("L_FAX", 'l_fax');
define("L_EMAIL", 'l_email');

//--räume
define("R_ID", 'r_id');
define("R_NR", 'r_nr');
define("R_DESC", 'r_bezeichnung');
define("R_NOTE", 'r_notiz');

//--arten
define("K_ID", 'ha_id');
define("K_NAME", 'ha_hardwareart');

//--attribute
define("A_ID", 'hat_id');
define("A_DESC", 'hat_bezeichnung');

//--wird_beschrieben_durch
define("KA_K_ID", 'hardwarearten_ha_id');
define("KA_A_ID", 'hardwareattribute_hat_id');

//--hardware_hat_attribute
define("HA_ID", 'hardware_h_id');
define("HA_A_ID", 'hardwareattribute_hat_id');
define("HA_VALUE", 'hhhat_wert');


function getComponents(){
    global $connection;
    $query = 'SELECT * FROM '.HARDWARE;
    return mysqli_query($connection, $query);
}
function getComponentsPlus(){
    global $connection;
    $query = 'SElECT comp.*, rooms.'.R_NR.' AS raumnummer, supp.'.L_COMPANY_NAME.' AS firmenname FROM '.HARDWARE.' AS comp '
            .' INNER JOIN '.ROOMS.' AS rooms ON rooms.'.R_ID.' = comp.'.H_ROOM_ID.' '
            .' INNER JOIN '.SUPPLIERS.' AS supp ON supp.'.L_ID.' = comp.'.H_SUPPLIER_ID;
    return mysqli_query($connection, $query);
}
function getAttributesByKaID($ka_id){
    global $connection;
    $query = 'SELECT attr.* FROM '.ATTRIBUTES.' AS attr '
            .' INNER JOIN '.DESCRIBED.' AS bes ON attr.'.A_ID.' = bes.'.KA_A_ID
            .'WHERE bes.komponenten_ka_id = ' . $ka_id;
    return mysqli_query($connection, $query);
}
function getEntriesByTable($tabname){
    global $connection;
    $query = 'SELECT * FROM '.$tabname;
    return mysqli_query($connection, $query);
}

function getOneByTableAndID($tabname, $id){
    global $connection;
    $prim = [
        HARDWARE => H_ID,
        ROOMS => R_ID,
        SUPPLIERS => L_ID,
        KINDS => K_ID,
        ATTRIBUTES => A_ID
    ];
    $query = 'SELECT * FROM '.$tabname.' WHERE '.$prim[$tabname].'='.$id;
    $results = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($results);
}

function getRooms(){
    global $connection;
    $query = 'SELECT * FROM '.ROOMS;
    return mysqli_query($connection, $query);
}
function getSuppliers(){
    global $connection;
    $query = 'SELECT * FROM '.SUPPLIERS;
    return mysqli_query($connection, $query);
}

function copyComponent($k_id, $count){
    global $connection;
    if($count < 1) return;
    $comp = getComponentByID($k_id);
    if($comp == null) return;
    $query = 'INSERT INTO komponenten '
        .'(raeume_r_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, komponentenarten_ka_id) VALUES ';
    $val = '('.$comp['raeume_r_id'].','.$comp['lieferant_l_id'].','.$comp['k_einkaufsdatum'].','
        .$comp['k_gewaehrleistungsdauer'].','.$comp['k_notiz'].','.$comp['k_hersteller'].','.$comp['komponentenarten_ka_id'].')';
    for($i = 0; $i < $count; $i++){
        $query .= $val;
        if($i != $count-1){
            $query .= ',';
        }
    }
    mysqli_query($connection, $query);
}
function deleteRoomByID($r_id){
    global $connection;
    $query = 'DELETE FROM raeume WHERE r_id='.$r_id;
    mysqli_query($connection, $query);
}
function deleteSupplierByID($l_id){
    global $connection;
    $query = 'DELETE FROM lieferant WHERE l_id='.$l_id;
    mysqli_query($connection, $query);
}
function deleteComponentByID($k_id){
    global $connection;
    $query = 'DELETE FROM komponenten WHERE k_id='.$k_id;
    mysqli_query($connection, $query);
}
//TODO: Löschweitergabe??
function deleteAttributeByID($kat_id){
    global $connection;
    $query = 'DELETE FROM komponentenattribute WHERE kat_id='.$kat_id;
    mysqli_query($connection, $query);
}
function deleteKindByID($ka_id){
    global $connection;
    $query = 'DELETE FROM komponentenarten WHERE ka_id='.$ka_id;
    mysqli_query($connection, $query);
}
function deleteEntryByTableAndID($tabname, $id){
    global $connection;
    switch($tabname){
        case 'komponenten':
            deleteComponentByID($id);
            break;
        case 'lieferant':
            deleteSupplierByID($id);
            break;
        case 'raeume':
            deleteRoomByID($id);
            break;
        case 'komponentenarten':
            deleteKindByID($id);
            break;
        case 'komponentenattribute':
            deleteAttributeByID($id);
            break;
        default:
            break;
    }
}
function insertComponent($data){
    global $connection;
    $r_id = $data[H_R_ID];
    $l_id = $data[H_L_ID];
    $k_edate = mysqli_real_escape_string($data['k_einkaufsdatum']);
    $k_gwd = $data['k_gewaehrleistungsdauer'];
    $k_notiz = mysqli_real_escape_string($data['k_notiz']);
    $supp = mysqli_real_escape_string($data['k_hersteller']);
    $kind = $data['komponentenarten_ka_id'];

    $query = 'INSERT INTO komponenten '
        . '(raeume_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, k_komponentenarten_ka_id) '
        . ' VALUES ('.$r_id.','.$l_id.','.$k_edate.','.$k_gwd.','.$k_notiz.','.$supp.','.$kind.')';
    mysqli_query($connection, $query);
}
function insertIntoTable($tabname, $data){
    global $connection;
    $keys = array_keys($data);
    $count = count($data);
    $query = 'INSERT INTO '.$tabname.' (';
    for($i = 0; $i < $count; $i){
        $query .= $keys[$i];
        if($i == $count-1){
            $query .= ')';
        }else{
            $query .= ',';
        }
    }
    $query .= ' VALUES (';
    for($i = 0; $i < $count; $i++){
        $query .= '"' . mysqli_real_escape_string($data[$keys[$i]]) . '"';
        if($i == $count-1){
            $query .= ')';
        }else{
            $query .= ',';
        }
    }
    mysqli_query($connection, $query);
}

