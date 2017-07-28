<?php
require_once('database.php');

define("HARDWARE", 'hardware');
define("HARDWARE_ATTRIBUTES", 'hardware_hat_attribute');
define("HARDWARE_KINDS", 'hardwarearten');
define("SUPPLIERS", 'lieferant');
define("ROOMS", 'raeume');
define("ATTRIBUTES", 'hardwareattribute');
define("DESCRIBED", 'wird_beschrieben_durch');
define("SOFTWARE", 'software');
define("SOFTWARE_ROOM", 'software_in_raum');
define("USERS", "users");

//--hardware
define("H_ID", 'h_id');
define("H_ROOM_ID", 'raeume_r_id');
define("H_SUPPLIER_ID", 'lieferant_l_id');
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
define("L_DELETED", 'l_ausgemustert');

//--räume
define("R_ID", 'r_id');
define("R_NR", 'r_nr');
define("R_DESC", 'r_bezeichnung');
define("R_NOTE", 'r_notiz');
define("R_DELETED", 'r_ausgemustert');

//--arten
define("K_ID", 'ha_id');
define("K_NAME", 'ha_hardwareart');
define("K_DELETED", 'ha_ausgemustert');

//--attribute
define("A_ID", 'hat_id');
define("A_DESC", 'hat_bezeichnung');
define("A_DELETED", 'hat_ausgemustert');

//--wird_beschrieben_durch
define("KA_K_ID", 'hardwarearten_ha_id');
define("KA_A_ID", 'hardwareattribute_hat_id');

//--hardware_hat_attribute
define("HA_H_ID", 'hardware_h_id');
define("HA_A_ID", 'hardwareattribute_hat_id');
define("HA_VALUE", 'hhhat_wert');

//--software
define("S_ID", 's_id');
define("S_NAME", 's_name');
define("S_DESC", 's_bez');
define("S_BUY_DATE", 's_einkaufsdatum');
define("S_LICENCE_DURATION", 's_lizenzlaufzeit');
define("S_NOTE", 's_notiz');
define("S_DEV", 's_hersteller');
define("S_VNR", 's_vnr');
define("S_LICENCE_TYPE", 's_lizenztyp');
define("S_COUNT", 's_anzahl');
define("S_LICENCE_INFO", 's_lizenzinformation');
define("S_INSTALL", 's_installhinweis');

//--nutzer
define("U_ID", "id");
define("U_USERNAME", "username");
define("U_PASSWORD", "PASSWORD");

//--nutzer-rollen
define("U_ROLES_ID", "U_ROLES_ID");
define("U_ROLES_ROLE", "role");

//--nutzer-hat-rollen
define("U_HAS_ROLES_ID", "id");
define("U_HAS_ROLES_U_ID", "id_users");
define("U_HAS_ROLES_U_ROLE", "id_roles");

//--software in raum
define("SR_R_ID", 'sir_r_id');
define("SR_S_ID", 'sir_h_id');

//--ausgemustert flag
define("FLAG_DELETED", 'TRUE');
define("FLAG_UNDELETED", 'FALSE');
define("DELETED_ROOM_ID", 1);

$prims = [
    HARDWARE => H_ID,
    ROOMS => R_ID,
    SUPPLIERS => L_ID,
    HARDWARE_KINDS => K_ID,
    ATTRIBUTES => A_ID,
    SOFTWARE => S_ID
];
$dels = [
    ROOMS => R_DELETED,
    SUPPLIERS => L_DELETED,
    ATTRIBUTES => A_DELETED,
    HARDWARE_KINDS => K_DELETED
];

$structure = array();
$structure[SUPPLIERS] = [
    L_COMPANY_NAME,
    L_STREET,
    L_PLZ,
    L_TOWN,
    L_TEL,
    L_MOBILE,
    L_FAX,
    L_EMAIL,
    L_DELETED
];
$structure[ROOMS] = [
    R_NR,
    R_DESC,
    R_NOTE,
    R_DELETED
];
$structure[SOFTWARE] = [
    S_NAME,
    S_DESC,
    S_BUY_DATE,
    S_LICENCE_DURATION,
    S_NOTE,
    S_DEV,
    S_VNR,
    S_LICENCE_TYPE,
    S_COUNT,
    S_LICENCE_INFO,
    S_INSTALL
];
$structure[HARDWARE] = [
    H_ROOM_ID,
    H_SUPPLIER_ID,
    H_NAME,
    H_DESC,
    H_BUY_DATE,
    H_WARRANTY,
    H_NOTE,
    H_DEV
];

function hasDeleteFlag($tabname){
    global $dels;
    foreach($dels as $key => $val){
        if($key == $tabname) return true;
    }
    return false;
}


/**
 * Hardwarekomponenten für die Tabellenanzeige
 * @return bool|mysqli_result
 */
function getHardwarePlus(){
    global $connection;
    $query = 'SElECT comp.*, rooms.'.R_NR.' AS '.R_NR
            .', supp.'.L_COMPANY_NAME.' AS '.L_COMPANY_NAME
            .', kinds.'.K_NAME.' AS '.K_NAME
            .' FROM '.HARDWARE.' AS comp '
            .' INNER JOIN '.ROOMS.' AS rooms ON rooms.'.R_ID.' = comp.'.H_ROOM_ID.' '
            .' INNER JOIN '.SUPPLIERS.' AS supp ON supp.'.L_ID.' = comp.'.H_SUPPLIER_ID.' '
            .' INNER JOIN '.HARDWARE_KINDS.' AS kinds ON kinds.'.K_ID.'=comp.'.H_KIND_ID
            .' WHERE NOT rooms.'.R_ID.'='.DELETED_ROOM_ID;
    return mysqli_query($connection, $query);
}
function getSoftwarePlus(){
    global $connection;
    $query = 'SELECT * FROM '.SOFTWARE.' WHERE '.S_ID
            .' NOT IN (SELECT '.SR_S_ID.' FROM '.SOFTWARE_ROOM.' AS sr WHERE '.SR_R_ID.'='.DELETED_ROOM_ID.')';
    return mysqli_query($connection, $query);
}
function getKindAttributesByHardwareID($h_id){
    global $connection;
    $kind = getKindOfHardware($h_id);
    $attr = getAttributesByKindID($kind[K_ID]);
    $ret = array();
    $ret[K_NAME] = $kind[K_NAME];
    $all = array();
    while($data = mysqli_fetch_assoc($attr)){
        $one = array();
        $one[A_ID] = $data[A_ID];
        $one[A_DESC] = $data[A_DESC];
        $one[HA_VALUE] = getAttributeValue($h_id, $data[A_ID]);
        $all[] = $one;
    }
    $ret['Attributes'] = $all;
    return $ret;
}
function getKindOfHardware($h_id){
    global $connection;
    $query = 'SELECT * FROM '.HARDWARE_KINDS.' AS kinds INNER JOIN '
        . HARDWARE.' AS comp ON comp.'.H_KIND_ID.'=kinds.'.K_ID.' WHERE comp.'.H_ID.'='.$h_id;
    $result = mysqli_query($connection, $query);
    if($result){
        return mysqli_fetch_assoc($result);
    }else{
        return null;
    }
}
function getAttributeValue($h_id, $a_id){
    global $connection;
    $query = 'SELECT '.HA_VALUE.' FROM '.HARDWARE_ATTRIBUTES
        .' WHERE '.HA_H_ID.'='.$h_id.' AND '.HA_A_ID.'='.$a_id;
    $result = mysqli_query($connection, $query);
    if($result){
        $data = mysqli_fetch_assoc($result);
        return $data[HA_VALUE];
    }else{
        return '';
    }
}

/**
 * zusätzliche Attribute einer Hardwareart
 * @param $ka_id: Primärschlüssel der Hardwareart
 * @param $exclude: wenn true werden Attribute ausgegeben, die der gegebenen Art noch nicht zugeordnet sind
 * @return bool|mysqli_result
 */
function getAttributesByKindID($ka_id, $exclude = false){
    global $connection;
    $query = 'SELECT attr.* FROM '.ATTRIBUTES.' AS attr '
            .' WHERE '
            .' attr.'.A_DELETED.'='.FLAG_UNDELETED.' AND '
            .' attr.'.A_ID.($exclude ? ' NOT':'').' IN (SELECT descr.'.KA_A_ID.' FROM '.DESCRIBED
            .' AS descr WHERE descr.'.KA_K_ID.'='.$ka_id.');';
    return mysqli_query($connection, $query);
}
/**
 * alle Einträge aus einer Datenbanktabelle
 * @param $tabname: Name der Datenbanktabelle
 * @return bool|mysqli_result
 */
function getEntriesByTable($tabname){
    if($tabname == HARDWARE){
        return getHardwarePlus();
    }else if($tabname == SOFTWARE){
        return getSoftwarePlus();
    }else{
        global $connection;
        global $dels;
        $query = 'SELECT * FROM ' . $tabname;
        if(hasDeleteFlag($tabname)){
            $query .= ' WHERE '.$dels[$tabname].'='.FLAG_UNDELETED;
            if($tabname == ROOMS){
                $query .= ' AND NOT '.R_ID.'='.DELETED_ROOM_ID;
            }
        }
        return mysqli_query($connection, $query);
    }
}

/**
 * einen Eintrag aus einer Datenbanktabelle holen
 * @param $tabname: Name der Datenbanktabelle
 * @param $id: ID des gesuchten Eintrages
 * @return array|null
 */
function getOneByTableAndID($tabname, $id){
    global $connection;
    global $prims;
    $query = 'SELECT * FROM '.$tabname.' WHERE '.$prims[$tabname].'='.$id;
    $results = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($results);
}

/**
 * Optionen für ein Dropdownmenü, damit die auswählbaren Werte vorgegeben werden können.
 * Z.B. einer Hardwarekomponente wird soll nur ein exestierender Raum zugeordnet werden können.
 * @param $tabname: Name der Datenbanktabelle
 * @param $id: ID der  bereits ausgewählten Komponente
 * @return array
 */
function getOptions($tabname, $id){
    global $connection;
    global $prims;
    global $dels;
    $options = array();
    $query = 'SELECT * FROM '.$tabname;
    if(hasDeleteFlag($tabname)){
        $query .= ' WHERE '.$dels[$tabname].'='.FLAG_UNDELETED;
    }
    $results = mysqli_query($connection, $query);
    while($data = mysqli_fetch_assoc($results)){
        $arr = array();
        $arr['Elem'] = $data;
        $arr['selected'] = $data[$prims[$tabname]] == $id;
        $options[] = $arr;
    }
    return $options;
}
function getRoomOptions($id){
    return getOptions(ROOMS, $id);
}
function getSupplierOptions($id){
    return getOptions(SUPPLIERS, $id);
}
function getKindOptions($id){
    return getOptions(HARDWARE_KINDS, $id);
}


/**
 * kopiert eine Hardwarekomponente
 * @param $k_id: id der zu kopierenden Hardwarekomponente
 * @param $count: wie oft soll diese Komponente kopiert werden
 */
function copyComponent($k_id, $count){
    /*
    global $connection;
    if($count < 1) return;
    $comp = getOneByTableAndID(HARDWARE, $k_id);
    if($comp == null) return;
    $query = 'INSERT INTO '.HARDWARE
        .'('.H_NAME.','.H_ROOM_ID.', '.H_SUPPLIER_ID.', '.H_BUY_DATE.', '.H_WARRANTY.', '.H_NOTE.', '.H_DEV.', '.H_KIND_ID.') VALUES ';
    $val = '("'.$comp[H_NAME].'",'.$comp[H_ROOM_ID].','.$comp[H_SUPPLIER_ID].',"'.$comp[H_BUY_DATE].'",'
        .$comp[H_WARRANTY].',"'.$comp[H_NOTE].'","'.$comp[H_DEV].'",'.$comp[H_KIND_ID].')';
    for($i = 0; $i < $count; $i++){
        $query .= $val;
        if($i != $count-1){
            $query .= ',';
        }
    }
    mysqli_query($connection, $query);
    */
    copyEntryFunction(HARDWARE, $k_id, $count);
}
function copyEntryFunction($tabname, $id, $count){
    global $connection;
    global $structure;
    $cols = $structure[$tabname];
    $colcount = count($cols);

    $data = getOneByTableAndID($tabname, $id);
    $query = 'INSERT INTO '.$tabname.' (';
    for($i= 0; $i < $colcount; $i++){
        $query .= $cols[$i];
        if($i < $colcount - 1){
            $query .= ',';
        }
    }
    $query .= ') VALUES ';
    for($i = 0; $i < $count; $i++){
        $vals = '(';
        for($j = 0; $j < $colcount; $j++){
            $val = $data[$cols[$j]];
            $val = mysqli_real_escape_string($connection, $val);
            $vals .= '"'.$val.'"';
            if($j < $colcount - 1){
                $vals .= ',';
            }
        }
        $vals .= ')';
        $query .= $vals;
        if($i < $count - 1){
            $query . ',';
        }
    }
    mysqli_query($connection, $query);
    if($tabname == HARDWARE){
        $first = mysqli_insert_id($connection);
        $query = 'SELECT * FROM '.HARDWARE_ATTRIBUTES.' WHERE '.HA_H_ID.'='.$id;
        $result = mysqli_query($connection, $query);
        $attrs = array();
        while($ha = mysqli_fetch_assoc($result)){
            $attrs[$ha[HA_A_ID]] = mysqli_real_escape_string($connection, $ha[HA_VALUE]);
        }
        //$a_ids = array_keys($attrs);
        for($i = 0; $i < $count; $i++){
            $current = $first + $i;
            $query_start = 'INSERT INTO '.HARDWARE_ATTRIBUTES.' ('.HA_H_ID.', '.HA_A_ID.', '.HA_VALUE.') VALUES ';
            foreach($attrs as $key => $val){
                $query_val = '('.$current.','.$key.',"'.$val.'")';
                $query = $query_start . $query_val;
                mysqli_query($connection, $query);
            }
        }
    }
}

function softDeleteWithFlag($connection, $tabname, $id){
    global $prims;
    global $dels;
    $query = 'UPDATE '.$tabname.' SET '.$dels[$tabname].'='.FLAG_DELETED
        .' WHERE '.$prims[$tabname].'='.$id;
    mysqli_query($connection, $query);
}
/**
 * löscht einen Raum
 * @param $r_id: ID des zu löschenden Raums
 */
function deleteRoomByID($r_id){
    global $connection;
    softDeleteWithFlag($connection, ROOMS, $r_id);
}
/**
 * löscht einen Lieferanten
 * @param $l_id: ID des zu löschenden Lieferanten
 */
function deleteSupplierByID($l_id){
    global $connection;
    softDeleteWithFlag($connection, SUPPLIERS, $l_id);
}
/**
 * löscht ein Hardwareattribut
 * @param $kat_id: ID des zu löschenden Attributs
 */
function deleteAttributeByID($kat_id){
    global $connection;
    softDeleteWithFlag($connection, ATTRIBUTES, $kat_id);
}
/**
 * löscht eine Hardwareart
 * @param $ka_id: ID der zu löschenden Hardwareart
 */
function deleteKindByID($ka_id){
    global $connection;
    softDeleteWithFlag($connection, HARDWARE_KINDS, $ka_id);
}

/**
 * löscht eine Hardwarekomponente
 * @param $k_id: ID der zu löschenden Hardwarekomponente
 */
function deleteHardwareByID($k_id){
    global $connection;
    $query = 'UPDATE '.HARDWARE.' SET '.H_ROOM_ID.'='.DELETED_ROOM_ID.' WHERE '.H_ID.'='.$k_id;
    mysqli_query($connection, $query);
}
function deleteSoftware($s_id){
    global $connection;
    $query = 'DELETE FROM '.SOFTWARE_ROOM.' WHERE '.SR_S_ID.'='.$s_id;
    mysqli_query($connection, $query);
    $query = 'INSERT INTO '.SOFTWARE_ROOM.' ('.SR_S_ID.','.SR_R_ID.') VALUES ('.$s_id.','.DELETED_ROOM_ID.')';
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
            deleteHardwareByID($id);
            break;
        case SOFTWARE:
            deleteSoftware($id);
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
    for($i = 0; $i < $count; $i++){
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

/**
 * ändern eines Datenbankeintrages
 * @param $tabname: Name der Datenbanktabelle
 * @param $data:
 */
function updateEntry($tabname, $data){
    global $connection;
    global $prims;
    $primcol = $prims[$tabname];
    $query = 'UPDATE ' . $tabname . ' SET ';
    $index = 0;
    foreach($data as $col => $val){
        $index++;
        if($col == $primcol){
            continue;
        }
        $query .= $col . '="' . mysqli_real_escape_string($connection, $val) . '"';
        if($index < count($data)){
            $query .= ', ';
        }
    }
    $query .= ' WHERE ' . $primcol . ' = ' . $data[$primcol];
    mysqli_query($connection, $query);
}
function updateHardwareAttribut($h_id, $a_id, $val){
    global $connection;
    $val = mysqli_real_escape_string($connection, $val);
    $query = 'UPDATE '.HARDWARE_ATTRIBUTES
        .' SET '.HA_VALUE.'="'.$val.'"'
        .' WHERE '.HA_H_ID.'='.$h_id.' AND '.HA_A_ID.'='.$a_id;
    mysqli_query($connection, $query);
}
function addNewAttributeToKind($k_id, $val){
    global $connection;
    $val = mysqli_real_escape_string($connection, $val);
    $query = 'INSERT INTO '.ATTRIBUTES.'('.A_DESC.') VALUES ("'.$val.'")';
    mysqli_query($connection, $query);
    $a_id = mysqli_insert_id($connection);
    addExistingAttributeToKind($k_id, $a_id);
}
function addExistingAttributeToKind($k_id, $a_id){
    global $connection;
    $query = 'INSERT INTO '.DESCRIBED.' ('.KA_K_ID.','.KA_A_ID.') VALUES ('.$k_id.','.$a_id.')';
    mysqli_query($connection, $query);
}
function removeAttributeFromKind($k_id, $a_id){
    global $connection;
    $query = 'DELETE FROM '.DESCRIBED.' WHERE '.KA_K_ID.'='.$k_id.' AND '.KA_A_ID.'='.$a_id;
    mysqli_query($connection, $query);
}
function updateHardwareAttributesAfterKindChange($old, $new, $k_id){
    global $connection;
    $query = 'UPDATE '.HARDWARE_ATTRIBUTES.' SET '.HA_A_ID.'='.$new.' WHERE '.HA_A_ID.'='.$old
            .' AND '.HA_H_ID.' IN (SELECT comp.'.H_ID.' FROM '.HARDWARE
            .' AS comp INNER JOIN '.HARDWARE_KINDS.' AS kinds ON kinds.'.K_ID.'=comp.'.H_KIND_ID
            .' WHERE kinds.'.K_ID.'='.$k_id.')';
    mysqli_query($connection, $query);
}