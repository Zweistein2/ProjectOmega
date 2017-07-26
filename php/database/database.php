<?php

require_once "config.php";

$connection = mysqli_connect($ip, $user, $pass, $db);
$connection_userDatabase = mysqli_connect($ip_userDatabase, $user_userDatabase, $pass_userDatabase, $db_userDatabase);

function getUser($username, $password)
{
    $query = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "';";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $user = mysqli_fetch_all($result, MYSQLI_BOTH);
    return $user;
}


function getUserPriviligesByUserId($userid)
{
    $query = "SELECT
                users.id,
                user_privileges.canAccessStammdatenverwaltung,
                user_privileges.canAccessNeubeschaffung,
                user_privileges.canAccessAusmusterung,
                user_privileges.canAccessReporting
              FROM
                users
              INNER JOIN user_privileges ON user_privileges.id_users = users.id
              WHERE users.id = $userid;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    $userPrivileges = mysqli_fetch_all($result, MYSQLI_BOTH);
    return $userPrivileges[0];
}


function getAllUsers()
{
    $query = "SELECT * FROM users;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    return $result;
}

function getAllUsersWithPrivileges()
{
    $query = "SELECT
                users.id,
                users.username,
                users.password,
                user_privileges.canAccessStammdatenverwaltung,
                user_privileges.canAccessNeubeschaffung,
                user_privileges.canAccessAusmusterung,
                user_privileges.canAccessReporting
              FROM
                users
              INNER JOIN user_privileges ON user_privileges.id_users = users.id;";
    global $connection_userDatabase;
    $result = mysqli_query($connection_userDatabase, $query);
    return $result;
}