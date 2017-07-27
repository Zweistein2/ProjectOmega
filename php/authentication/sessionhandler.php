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

function createSessionForUser($username, $password)
{
    $hashedPassword = getPasswordHash($password);
    $userArray = getUserWithRole($username, $hashedPassword);
    if (!empty($userArray)) {
        $user = $userArray[0];
        setUserIdSession($user['id']);
        setUserGroupSession($user['role']);
        // Wenn evtl. eine Fehlermeldung besteht
        deleteErrorMessage();
        redirectTo("help.php");
    } else {
        createErrorMessage("Sie haben falsche Anmeldeinformationen eingeben!");
    }
}

function hasSession()
{
    if (isset($_SESSION['userid']) && isset($_SESSION['user_role'])) {
        return true;
    }
    return false;
}

function getUserIdSession()
{
    return $_SESSION['userid'];
}

function setUserIdSession($id){
    $_SESSION['userid'] = $id;
}

function getUserGroupSession()
{
    return $_SESSION['user_role'];
}

function setUserGroupSession($id){
    $_SESSION['user_role'] = $id;
}

function deleteSession()
{
    session_unset(getUserIdSession());
    session_unset(getUserGroupSession());
}

function createErrorMessage($message)
{
    $_SESSION['error'] = $message;
}

function hasErrorMessage()
{
    if (isset($_SESSION['error'])) {
        return true;
    }
    return false;
}

function getErrorMessage()
{
    $errorMessage = $_SESSION['error'];
    return $errorMessage;
}


function deleteErrorMessage()
{
    session_unset($_SESSION['error']);
}
