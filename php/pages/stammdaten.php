<?php

//stammdaten.php
//Kopfdatei für stammdaten_komponenten.php

include("stammdaten.elements.php");

$dbElements = dbElements();

$type = getStammdatenType();

/**
 * @dbAlias: Enthält die Tabellennamen für SQL-Operationen, keys für dbElements und translator und
 *           um den Type auf Richtigkeit zu prüfen.
 */

function filterPassword($arr)
{

}

function getColumnNames($type, $includeId, $excludePassword)
{
    return getColumn($type, false, $includeId, $excludePassword);
}

function getColumnText($type, $includeId, $excludePassword)
{
    return getColumn($type, true, $includeId, $excludePassword);
}

function getColumn($type, $value, $includeId, $excludePassword)
{
    global $dbElements;
    $element = $dbElements[$type];
    unset($element['NAME']);
    unset($element['NAME_PLURAL']);
    unset($element['NAME_COLUMN']);
    unset($element['TABLE_NAME']);
    if (!$includeId) {

        if (isset($element['OPTION_REFERENCE'])) {
            $optionReference = $element['OPTION_REFERENCE'];
            foreach ($optionReference as $key => $val) {
                unset($element[$key]);
            }
        }

        if (isset($element['HIDDEN_COLUMNS'])) {
            $hiddenList = $element['HIDDEN_COLUMNS'];
            foreach ($hiddenList as $i) {
                unset($element[$i]);
            }
        }
        $idColumn = $element["ID_COLUMN"];
        unset($element[$idColumn]);
    }

    if ($excludePassword) {
        if (isset($element['PASSWORD_COLUMN'])) {
            $passwordColumn = $element['PASSWORD_COLUMN'];
            unset($element[$passwordColumn]);
        }
    }
    unset($element["PASSWORD_COLUMN"]);
    unset($element['HIDDEN_COLUMNS']);
    unset($element['OPTION_REFERENCE']);
    unset($element['ID_COLUMN']);
    if ($value) {
        return array_values($element);
    } else {
        return array_keys($element);
    }
}

function getOptionAttributes($type, $attribute)
{
    global $dbElements;
    $element = $dbElements[$type];

    if (isset($element['OPTION_REFERENCE'])) {
        $optionReference = $element['OPTION_REFERENCE'];
        foreach ($optionReference as $key => $value) {
            foreach ($element[$key] as $i) {
                if ($i == $attribute) {
                    return $value;
                }
            }
        }
    }

    return null;

}

function tableExist($type)
{
    global $dbElements;
    if (isset($dbElements[$type])) {
        return true;
    }
    return false;
}

function getTypeName($type, $plural)
{
    global $dbElements;
    $element = $dbElements[$type];
    $returnVal = $element['NAME'];
    if ($plural) {
        $returnVal = $element['NAME_PLURAL'];
    }
    return $returnVal;
}

function getIDColumn($type)
{
    global $dbElements;
    $element = $dbElements[$type];
    return $element['ID_COLUMN'];
}

function getNameColumn($type)
{
    global $dbElements;
    $element = $dbElements[$type];
    return $element['NAME_COLUMN'];
}

/**
 * getType: Prüft ob der GET-Parameter 'type' gesetzt wurde.
 * Mittels Type wird bestimmt welche Datenbank angesprochen werden soll.
 * Diese Funktion prüft ob ein legaler Type vorliegt, falls nicht wird die Ausführung verweigert.
 * Falls kein Type gesetzt wurde, wird auf den Type 'raeume' weitergeleitet.
 * Achtung: Muss in der PHP-Datei aufgerufen werden!
 */
function getStammdatenType()
{
    $returnType = "";
    if (isset($_GET["type"])) {
        $returnType = $_GET["type"];
        if (!tableExist($returnType)) {
            die();
        }
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?type=raeume");
        die();
    }
    return $returnType;
}

function getQuery($type, $id = null)
{
    if ($type == "users") {
        if ($id == null) {
            $return = getAllUsersWithRoles();
            return $return;
        } else {
            return getUserWithRoleById($id);
        }
    } else {
        if ($id == null) {
            return getEntriesByTable($type);
        } else {
            return getOneByTableAndID($type, $id);
        }
    }
}

function findOption($table, $id)
{
    if ($table == "users") {
        return getUserOptions($id);
    } else {
        return getOptions($table, $id);
    }
}
include("stammdaten_modal.php");

?>