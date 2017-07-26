<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 25.07.2017
 * Time: 08:49
 */

require_once("../authentication/sessionhandler.php");

function checkForMinAccess($userRole)
{
    if (hasSession()) {
        $searchUserWithId = getUserIdSession();
        $userArray = getUserWithRoleById($searchUserWithId);
        $user = $userArray[0];
        if(empty($userArray)){ // Es wurde kein Benutzer gefunden
            deleteSession();
            redirectToLogin();
        }
        if($user['role'] == null || $user['role'] == ''){
            deleteSession();
            redirectToLogin();
        }
        switch ($userRole) {
            case 'admin':
                if (strcmp($user['role'], "Admin") !== 0) {
                    redirectToLogin();
                }
                break;
            case 'lehrer':
                if (strcmp($user['role'], "Lehrer") !== 0) {
                    redirectToLogin();
                }
                break;
            default:
                redirectToLogin();
                break;
        }
    } else {
        redirectToLogin();
    }
}