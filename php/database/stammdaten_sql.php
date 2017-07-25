<?php
/**
 * Created by PhpStorm.
 * User: mkern
 * Date: 25.07.2017
 * Time: 09:34
 */
function getComponents(){
    global $connection;
    $query = 'SELECT * FROM komponenten';
    return mysqli_query($connection, $query);
}
function getComponentsPlus(){
    global $connection;
    $query = 'SElECT comp.*, rooms.r_nr AS raumnummer, supp.l_firmenname AS firmenname FROM komponenten AS comp '
            .' INNER JOIN raeume AS rooms ON rooms.r_id = comp.raeume_r_id '
            .' INNER JOIN lieferant AS supp ON supp.l_id = comp.lieferant_l_id';
    return mysqli_query($connection, $query);
}
function getAttributesByKaID($ka_id){
    global $connection;
    $query = 'SELECT attr.* FROM komponentenattribute AS attr '
            .' INNER JOIN wird_beschrieben_durch AS bes ON attr.kat_id = bes.komponentenattributte_kat_id '
            .'WHERE bes.komponenten_ka_id = ' . $ka_id;
    return mysqli_query($connection, $query);
}
function getRooms(){
    global $connection;
    $query = 'SELECT * FROM raeume';
    return mysqli_query($connection, $query);
}
function getSuppliers(){
    global $connection;
    $query = 'SELECT * FROM lieferant';
    return mysqli_query($connection, $query);
}
function getComponentByID($k_id){
    global $connection;
    $query = 'SELECT * FROM komponenten WHERE k_id = ' . $k_id;
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
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