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
define("H_KIND_ID", 'hardwarearten_ha_id');

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


/**
 * Hardwarekomponenten für die Tabellenanzeige
 * @return bool|mysqli_result
 */
function getComponentsPlus(){
    global $connection;
    $query = 'SElECT comp.*, rooms.'.R_NR.' AS raumnummer, supp.'.L_COMPANY_NAME.' AS firmenname FROM '.HARDWARE.' AS comp '
            .' INNER JOIN '.ROOMS.' AS rooms ON rooms.'.R_ID.' = comp.'.H_ROOM_ID.' '
            .' INNER JOIN '.SUPPLIERS.' AS supp ON supp.'.L_ID.' = comp.'.H_SUPPLIER_ID;
    return mysqli_query($connection, $query);
}

/**
 * zusätzliche Attribute einer Hardwareart
 * @param $ka_id: Primärschlüssel der Hardwareart
 * @return bool|mysqli_result
 */
function getAttributesByKindID($ka_id){
    global $connection;
    $query = 'SELECT attr.* FROM '.ATTRIBUTES.' AS attr '
            .' INNER JOIN '.DESCRIBED.' AS bes ON attr.'.A_ID.' = bes.'.KA_A_ID
            .'WHERE bes.'.KA_K_ID.' = ' . $ka_id;
    return mysqli_query($connection, $query);
}
/**
 * alle Einträge aus einer Datenbanktabelle
 * @param $tabname: Name der Datenbanktabelle
 * @return bool|mysqli_result
 */
function getEntriesByTable($tabname){
    if($tabname == HARDWARE){
        return getComponentsPlus();
    }
    global $connection;
    $query = 'SELECT * FROM '.$tabname;
    return mysqli_query($connection, $query);
}

/**
 * einen Eintrag aus einer Datenbanktabelle holen
 * @param $tabname: Name der Datenbanktabelle
 * @param $id: ID des gesuchten Eintrages
 * @return array|null
 */
function getOneByTableAndID($tabname, $id){
    global $connection;
    $prim = [
        HARDWARE => H_ID,
        ROOMS => R_ID,
        SUPPLIERS => L_ID,
        HARDWARE_KINDS => K_ID,
        ATTRIBUTES => A_ID
    ];
    $query = 'SELECT * FROM '.$tabname.' WHERE '.$prim[$tabname].'='.$id;
    $results = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($results);
}

/**
 * @return bool|mysqli_result (alle Räume)
 */
function getRooms(){
    global $connection;
    $query = 'SELECT * FROM '.ROOMS;
    return mysqli_query($connection, $query);
}

/**
 * @return bool|mysqli_result (alle Lieferanten)
 */
function getSuppliers(){
    global $connection;
    $query = 'SELECT * FROM '.SUPPLIERS;
    return mysqli_query($connection, $query);
}

/**
 * kopiert eine Hardwarekomponente
 * @param $k_id: id der zu kopierenden Hardwarekomponente
 * @param $count: wie oft soll diese Komponente kopiert werden
 */
function copyComponent($k_id, $count){
    global $connection;
    if($count < 1) return;
    $comp = getComponentByID($k_id);
    if($comp == null) return;
    $query = 'INSERT INTO '.HARDWARE
        .'('.H_ROOM_ID.', '.H_SUPPLIER_ID.', '.H_BUY_DATE.', '.H_WARRANTY.', '.H_NOTE.', '.H_DEV.', '.H_KIND_ID.') VALUES ';
    $val = '('.$comp[H_ROOM_ID].','.$comp[H_SUPPLIER_ID].',"'.$comp[H_BUY_DATE].'",'
        .$comp[H_WARRANTY].',"'.$comp[H_NOTE].'","'.$comp[H_DEV].'",'.$comp[H_KIND_ID].')';
    for($i = 0; $i < $count; $i++){
        $query .= $val;
        if($i != $count-1){
            $query .= ',';
        }
    }
    mysqli_query($connection, $query);
}

/**
 * löscht einen Raum
 * @param $r_id: ID des zu löschenden Raums
 */
function deleteRoomByID($r_id){
    global $connection;
    $query = 'DELETE FROM '.ROOMS.' WHERE '.R_ID.'='.$r_id;
    mysqli_query($connection, $query);
}

/**
 * löscht einen Lieferanten
 * @param $l_id: ID des zu löschenden Lieferanten
 */
function deleteSupplierByID($l_id){
    global $connection;
    $query = 'DELETE FROM '.SUPPLIERS.' WHERE '.L_ID.'='.$l_id;
    mysqli_query($connection, $query);
}

/**
 * löscht eine Hardwarekomponente
 * @param $k_id: ID der zu löschenden Hardwarekomponente
 */
function deleteComponentByID($k_id){
    global $connection;
    $query = 'DELETE FROM '.HARDWARE.' WHERE '.H_ID.'='.$k_id;
    mysqli_query($connection, $query);
}
//TODO: Löschweitergabe??
/**
 * löscht ein Hardwareattribut
 * @param $kat_id: ID des zu löschenden Attributs
 */
function deleteAttributeByID($kat_id){
    global $connection;
    $query = 'DELETE FROM '.ATTRIBUTES.' WHERE '.A_ID.'='.$kat_id;
    mysqli_query($connection, $query);
}

/**
 * löscht eine Hardwareart
 * @param $ka_id: ID der zu löschenden Hardwareart
 */
function deleteKindByID($ka_id){
    global $connection;
    $query = 'DELETE FROM '.HARDWARE_KINDS.' WHERE '.K_ID.'='.$ka_id;
    mysqli_query($connection, $query);
}

/**
 * löscht ein Element aus einer Datenbanktabelle
 * @param $tabname: Name der Datenbanktabelle
 * @param $id: ID des zu löschenden Elements
 */
function deleteEntryByTableAndID($tabname, $id){
    global $connection;
    switch($tabname){
        case HARDWARE:
            deleteComponentByID($id);
            break;
        case SUPPLIERS:
            deleteSupplierByID($id);
            break;
        case ROOMS:
            deleteRoomByID($id);
            break;
        case HARDWARE_KINDS:
            deleteKindByID($id);
            break;
        case ATTRIBUTES:
            deleteAttributeByID($id);
            break;
        default:
            break;
    }
}
/*
function insertComponent($data){
    global $connection;
    $r_id = $data[H_R_ID];
    $l_id = $data[H_L_ID];
    $k_edate = mysqli_real_escape_string($connection, $data[H_BUY_DATE]);
    $k_gwd = $data[H_WARRANTY];
    $k_notiz = mysqli_real_escape_string($connection, $data[H_NOTE]);
    $supp = mysqli_real_escape_string($connection, $data[H_SUPPLIER_ID]);
    $kind = $data[H_KIND_ID];

    $query = 'INSERT INTO '.HARDWARE
        . '(raeume_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, k_komponentenarten_ka_id) '
        . ' VALUES ('.$r_id.','.$l_id.','.$k_edate.','.$k_gwd.','.$k_notiz.','.$supp.','.$kind.')';
    mysqli_query($connection, $query);
}
*/
/**
 * fügt einen neuen Eintrag hinzu
 * @param $tabname: Name der Datenbanktabelle
 * @param $data: das neue Element
 */
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
        $query .= '"' . mysqli_real_escape_string($connection, $data[$keys[$i]]) . '"';
        if($i == $count-1){
            $query .= ')';
        }else{
            $query .= ',';
        }
    }
    mysqli_query($connection, $query);
}

