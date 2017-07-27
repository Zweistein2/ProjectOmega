<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf, Maxim Komov
 * Date: 26.07.2017
 * Time: 08:51
 */

require_once('database.php');
require_once("../helpers/cryption.php");

/**
 * Liefer ein Benutzer und dessen Gruppe als Array zurueck.
 *
 * @param $username
 * @param $password
 * @return array|null
 */
function getUserWithRole($username, $password)
{
    $query = "SELECT
            	users.id,
              	users.username,
              	users.password,
              	user_roles.role 
              FROM
              	users
              	INNER JOIN user_has_roles ON user_has_roles.id_users = users.id
              	INNER JOIN user_roles ON user_has_roles.id_roles = user_roles.id 
              WHERE
              	users.username = '$username' 
              	AND users.password = '$password' ;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $userArray = mysqli_fetch_all($result, MYSQLI_BOTH);
    return $userArray;
}

/**
 * Liefert die Benutzer Id zurueck anhand des Benutzernamen.
 *
 * @param $username
 * @return id|null
 */
function getUserIdByName($username)
{
    $query = "SELECT
            	users.id 
              FROM
              	users
              WHERE
              	users.username = '$username';";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $userArray = mysqli_fetch_all($result, MYSQLI_BOTH);
    if ($userArray != null) {
        $userId = $userArray[0];
        return $userId["id"];
    } else {
        return null;
    }
}

/**
 *  Liefer ein Benutzer und dessen Gruppe als Array zurueck.
 *
 * @param $id
 * @return array|null
 */
function getUserWithRoleById($id)
{
    $query = "SELECT
                users.id,
                users.username,
	            users.PASSWORD,
	            user_roles.role,
	            user_roles.id as 'U_ROLES_ID'
              FROM
	            users
	            INNER JOIN user_has_roles ON user_has_roles.id_users = users.id
	            INNER JOIN user_roles ON user_has_roles.id_roles = user_roles.id
	          WHERE
	            users.id = $id";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    return mysqli_fetch_assoc($result);
}

/**
 * Liefer alle Benutzer und die jeweilige Gruppe als Array zurueck.
 *
 * @return bool|mysqli_result
 */
function getAllUsersWithRoles()
{
    $query = "SELECT
                users.id,
                users.username,
                users.PASSWORD,
                user_roles.role,
                user_roles.id as 'U_ROLES_ID'
              FROM
                users
	            INNER JOIN user_has_roles ON user_has_roles.id_users = users.id
	            INNER JOIN user_roles ON user_has_roles.id_roles = user_roles.id;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    return $result;
}

/**
 * Erstellt einen Benutzer und dessen Benutzergruppe.
 *
 * @param $username
 * @param $password
 * @param $role
 */
function createUser($username, $password, $role)
{
    if (getUserIdByName($username) == null) {
        $hashedPassword = getPasswordHash($password);
        try {
            $query = "INSERT INTO users (username,password) VALUES ('$username','$hashedPassword');";
            global $connection_userDatabase;
            mysqli_query($connection_userDatabase, $query);
        } catch (Exception $e) {
            echo 'Exception abgefangen: ', $e->getMessage(), "\n";
        }
        assignUserToRoleByName($username, $role);
    } else {
        echo "<div class=\"alert alert-danger\"> Benutzername vergeben</div>";
    }
}

/**
 * Weisst einen Benutzer einer Benutzergruppe zu.
 *
 * @param $username
 * @param $roleId
 */
function assignUserToRoleByName($username, $roleId)
{
    $userId = getUserIdByName($username);
    if ($roleId != -1) {
        $queryForRole = "INSERT INTO user_has_roles (id_users,id_roles) VALUES ('$userId','$roleId');";
        global $connection_userDatabase;
        mysqli_query($connection_userDatabase, $queryForRole);
    }
}

/**
 * Liefert Benutzergruppen Id zurueck.
 *
 * @param $name
 * @return int
 */
function getRoleIdByName($name)
{
    $query = "SELECT
            	user_roles.id 
              FROM
              	user_roles 
              WHERE
              	user_roles.role = '$name';";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $fetchedRoleArray = mysqli_fetch_all($result, MYSQLI_BOTH);
    if (empty($fetchedRoleArray)) {
        return -1;
    }
    $role = $fetchedRoleArray['0'];
    return $role['id'];
}


/**
 * Liefert alle Benutzergruppen Namen zurueck.
 *
 * @return array|null
 */
function getAllRoleNames()
{
    $query = "SELECT
            	user_roles.role
              FROM
              	user_roles;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    return mysqli_fetch_all($result, MYSQLI_BOTH);
}

/**
 * Liefer Benutzer Optionen zurueck.
 *
 * @param $id
 * @return array
 */
function getUserOptions($id)
{
    global $connection_userDatabase;
    $options = array();
    $query = "SELECT
            	*
              FROM
              	user_roles;";
    $results = mysqli_query($connection_userDatabase, $query);
    while ($data = mysqli_fetch_assoc($results)) {
        $arr = array();
        $arr['Elem'] = $data;
        $arr['selected'] = $data["id"] == $id;
        $options[] = $arr;
    }
    return $options;
}

/**
 * Aktualisiert den Benutzer anhand des Benutzernames
 *
 * @param $username
 * @param $password
 * @param $roleId
 */
function updateUser($username, $password, $roleId)
{
    global $connection_userDatabase;
    $userId = getUserIdByName($username);
    if ($password != "") {
        $hashedPassword = getPasswordHash($password);
        $query = "UPDATE users SET password = '$hashedPassword' WHERE username = '$username';";
        mysqli_query($connection_userDatabase, $query);
    }
    $queryRole = "UPDATE user_has_roles SET id_roles = $roleId WHERE id_users = $userId;";
    mysqli_query($connection_userDatabase, $queryRole);
}

/**
 * Loescht den Benutzer anhand seiner Benutzer ID.
 *
 * @param $id
 */
function deleteUserById($id)
{
    $userQuery = "DELETE FROM users WHERE id = $id;";
    $roleQuery = "DELETE FROM user_has_roles WHERE id_users = $id;";
    global $connection_userDatabase;
    mysqli_query($connection_userDatabase, $userQuery);
    mysqli_query($connection_userDatabase, $roleQuery);
}