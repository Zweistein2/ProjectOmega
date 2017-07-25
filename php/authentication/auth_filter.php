<?php
/**
 * Created by PhpStorm.
 * Author: Sebastian Reuter, Thomas Wolf
 * Date: 25.07.2017
 * Time: 08:49
 */

require_once("./helpers/redirect.php");
require_once ("./authentication/UserPrivliges.class.php");


function checkForValidSessionInArea($area)
{
    session_start();
    if (isset($_SESSION['userid']) && isset($_SESSION['user_privliges'])) {
        $userPrivliges = $_SESSION['user_privliges'];
        switch ($area) {
            case 'stammdatenverwaltung':
                if (!$userPrivliges->canAccessStammdatenverwaltung) {
                    redirectToLogin();
                }
                break;
            case 'neubeschaffung':
                if (!$userPrivliges->canAccessNeubeschaffung) {
                    redirectToLogin();
                }
                break;
            case 'ausmusterung':
                if (!$userPrivliges->canAccessAusmusterung) {
                    redirectToLogin();
                }
                break;
            case 'reporting':
                if (!$userPrivliges->canAccessReporting) {
                    redirectToLogin();
                }
                break;
        }
        echo "welcome";
    } else {
        redirectToLogin();
    }
}