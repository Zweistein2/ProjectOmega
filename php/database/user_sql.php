<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 26.07.2017
 * Time: 08:51
 */

require_once('database.php');
require_once("../helpers/cryption.php");

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
        echo "Benutzername vergeben";
    }
}


function assignUserToRoleByName($username, $roleId)
{
    $userId = getUserIdByName($username);
    if ($roleId != -1) {
        $queryForRole = "INSERT INTO user_has_roles (id_users,id_roles) VALUES ('$userId','$roleId');";
        global $connection_userDatabase;
        mysqli_query($connection_userDatabase, $queryForRole);
    }
}


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

function deleteUserById($id)
{
    $userQuery = "DELETE FROM users WHERE id = $id;";
    $roleQuery = "DELETE FROM user_has_roles WHERE id_users = $id;";
    global $connection_userDatabase;
    mysqli_query($connection_userDatabase, $userQuery);
    mysqli_query($connection_userDatabase, $roleQuery);
}