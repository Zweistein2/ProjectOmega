<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 25.07.2017
 * Time: 08:49
 */

require_once("../authentication/sessionhandler.php");


/**
 * Legt fest welche min. Benutzergruppe der Benutzer
 * haben muss um den jeweiligen Bereich zu sehen.
 *
 * @param $userRole
 */
function checkForMinAccess($userRole)
{
    if (hasSession()) {
        $searchUserWithId = getUserIdSession();
        $userArray = getUserWithRoleById($searchUserWithId);
        $user = $userArray[0];
        if (empty($userArray)) { // Es wurde kein Benutzer gefunden
            deleteSession();
            redirectToLogin();
        }
        if (getUserGroupSession() == null || getUserGroupSession() == '') {
            deleteSession();
            redirectToLogin();
        }
        switch ($userRole) {
            case 'Admin':
                if (strcmp(getUserGroupSession(), "Admin") == 0) {
                    break;
                } else {
                    redirectTo("help.php");
                    break;
                }
                break;
            case 'Lehrer':
                if (strcmp(getUserGroupSession(), "Lehrer") == 0 || strcmp(getUserGroupSession(), "Admin") == 0) {
                    break;
                } else {
                    redirectTo("help.php");
                    break;
                }
                break;
            default:
                redirectTo("help.php");
                break;
        }
    } else {
        redirectToLogin();
    }
}