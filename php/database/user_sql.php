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



