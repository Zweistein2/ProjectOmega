<?php
/**
 * Created by PhpStorm.
 * Author: Thomas Wolf
 * Date: 26.07.2017
 * Time: 08:51
 */

require_once('database.php');
require_once ("../helpers/cryption.php");

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
    $userId = $userArray[0];
    return $userId["id"];
}

function getUserWithRoleById($id)
{
    $query = "SELECT
                users.id,
                users.username,
	            users.PASSWORD,
	            user_roles.role 
              FROM
	            users
	            INNER JOIN user_has_roles ON user_has_roles.id_users = users.id
	            INNER JOIN user_roles ON user_has_roles.id_roles = user_roles.id
	          WHERE
	            users.id = $id";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $fetchedUserArray = mysqli_fetch_all($result, MYSQLI_BOTH);
    return $fetchedUserArray;
}

function getAllUsersWithRoles()
{
    $query = "SELECT
                users.id,
                users.username,
                users.PASSWORD,
                user_roles.role 
              FROM
                users
	            INNER JOIN user_has_roles ON user_has_roles.id_users = users.id
	            INNER JOIN user_roles ON user_has_roles.id_roles = user_roles.id;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $fetchedUsersArray = mysqli_fetch_all($result, MYSQLI_BOTH);
    return $fetchedUsersArray;
}

function createUser($username,$password,$role){
    $hashedPassword = getPasswordHash($password);
    try {
        $query = "INSERT INTO users (username,password) VALUES ('$username','$hashedPassword');";
        global $connection_userDatabase;
        mysqli_query($connection_userDatabase, $query);
    } catch (Exception $e) {
        echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
    }
    assignUserToRoleByName($username,$role);
}


function assignUserToRoleByName($username,$role){
    $userId = getUserIdByName($username);
    $roleId = getRoleIdByName($role);
    if($roleId != -1){
        $queryForRole = "INSERT INTO user_has_roles (id_users,id_roles) VALUES ('$userId','$roleId');";
        global $connection_userDatabase;
        mysqli_query($connection_userDatabase, $queryForRole);
    }
}


function getRoleIdByName($name){
    $query = "SELECT
            	user_roles.id 
              FROM
              	user_roles 
              WHERE
              	user_roles.role = '$name';";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $fetchedRoleArray = mysqli_fetch_all($result, MYSQLI_BOTH);
    if(empty($fetchedRoleArray)){
        return -1;
    }
    $role = $fetchedRoleArray['0'];
    return $role['id'];
}

function getAllRoleNames(){
    $query = "SELECT
            	user_roles.role
              FROM
              	user_roles;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    return mysqli_fetch_all($result, MYSQLI_BOTH);
}


function updateUserByUsername($username,$password,$role){
    $hashedPassword = getPasswordHash($password);
    $userId = getUserIdByName($username);
    $roleId = getRoleIdByName($role);
    $query = "UPDATE users SET password = '.$hashedPassword.' WHERE username ='.$username.';";
    $queryRole = "UPDATE user_has_roles SET id_roles = $roleId WHERE id_users = $userId;";
    global $connection_userDatabase;
    mysqli_query($connection_userDatabase, $query);
    mysqli_query($connection_userDatabase, $queryRole);
}

function deleteUserById($id){
    $userQuery = "DELETE FROM users WHERE id = $id;";
    $roleQuery = "DELETE FROM user_has_roles WHERE id_users = $id;";
    global $connection_userDatabase;
    mysqli_query($connection_userDatabase, $roleQuery);
    mysqli_query($connection_userDatabase, $userQuery);
}