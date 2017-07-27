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

function setUserIdSession($id)
{
    $_SESSION['userid'] = $id;
}

function getUserGroupSession()
{
    return $_SESSION['user_role'];
}

function setUserGroupSession($id)
{
    $_SESSION['user_role'] = $id;
}

function deleteSession()
{
    unset($_SESSION['userid']);
    unset($_SESSION['user_role']);
}

function createErrorMessage($message)
{
    setcookie("error", $message, time() + 300);
}

function hasErrorMessage()
{
    if (isset($_COOKIE["error"])) {
        return true;
    }
    return false;
}

function getErrorMessage()
{
    $errorMessage = $_COOKIE["error"];
    return $errorMessage;
}


function deleteErrorMessage()
{
    setcookie("error", "", time() - 3600);
}
