<?php
// * Created by PhpStorm.
// * Author: Thomas Wolf
// * Date: 24.07.2017
// * Time: 13:27

/**
 * Hashed das Passwort und liefert den Hash zurueck.
 *
 * @param $password
 * @return string
 */
function getPasswordHash($password){
    return md5($password);
}