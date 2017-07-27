<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 25.07.2017
 * Time: 10:04
 */

require_once("../helpers/redirect.php");
require_once("../helpers/cryption.php");
require_once("../database/user_sql.php");

session_start();

/**
 * Erstellt eine neue Session um den Bentuzer zu authentifizieren.
 * Wird der Benutzer nicht in der Datenbank gefunden so wird
 * eine Fehlermeldung erzeugt.
 *
 * @param $username
 * @param $password
 */
function createSessionForUser($username, $password)
{
    $hashedPassword = getPasswordHash($password);
    $userArray = getUserWithRole($username, $hashedPassword);
    if (!empty($userArray)) {
        $user = $userArray[0];
        setUserIdSession($user['id']);
        setUserGroupSession($user['role']);
        echo "nach der if";
        // Wenn evtl. eine Fehlermeldung besteht
        deleteErrorMessage();
        redirectTo("help.php");
    } else {
        createErrorMessage("Sie haben falsche Anmeldeinformationen eingeben!");
    }
}

/**
 * Ueberprueft ob eine Authentifizierung Session besteht.
 *
 * @return bool
 */
function hasSession()
{
    if (isset($_SESSION['userid']) && isset($_SESSION['user_role'])) {
        return true;
    }
    return false;
}

/**
 * Liefert die Benutzer ID von der Authentifizierung Session zurueck.
 *
 * @return integer
 */
function getUserIdSession()
{
    return $_SESSION['userid'];
}

/**
 * Setzt die Benutzer ID in der Authentifizierung Session.
 *
 * @param $id
 */
function setUserIdSession($id){
    $_SESSION['userid'] = $id;
}

/**
 * Liefert die Benutzer Gruppe von der Authentifizierung Session zurueck.
 *
 * @return integer
 */
function getUserGroupSession()
{
    return $_SESSION['user_role'];
}

/**
 * Setzt die Benutzer Gruppe in der Authentifizierung Session.
 *
 * @param $id
 */
function setUserGroupSession($id){
    $_SESSION['user_role'] = $id;
}


/**
 * Loescht die Authentifizierung Session
 *
 */
function deleteSession()
{
    session_unset();
}

/**
 * Setzt eine Fehlermeldung in der Session.
 *
 * @param $message
 */
function createErrorMessage($message)
{
    $_SESSION['error'] = $message;
}


/**
 * Ueberprueft ob eine Fehlermeldung in der Session besteht.
 *
 * @return bool
 */
function hasErrorMessage()
{
    if (isset($_SESSION['error'])) {
        if(strcmp(getErrorMessage(), "") !== 0){
            return true;
        }
        return false;
    }
    return false;
}

/**
 * Liefert die Fehlermeldung von der Session zurueck.
 *
 * @return string
 */
function getErrorMessage()
{
    $errorMessage = $_SESSION['error'];
    return $errorMessage;
}


/**
 * Loescht die Fehlermeldung in der Session.
 *
 */
function deleteErrorMessage()
{
    createErrorMessage('');
}
