<!--
 * Created by PhpStorm.
 * Author: Sebastian Reuter, Thomas Wolf
 * Date: 24.07.2017
 * Time: 14:10
 -->

<?php
require_once("../authentication/sessionhandler.php");

if (isset($_POST['btn_anmelden'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        createSessionForUser($_POST['username'], $_POST{'password'});
    } else {
        createErrorMessage("Bitte die Maske ausfüllen!");
    }
}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <?php include("../template/head.template.php"); ?>
    <link href="../../css/login.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="container">
        <div class="card card-container">
            <h2 class='login_title text-center'>Anmeldung</h2>
            <hr>
            <?php
            if (hasErrorMessage()) {
                echo getErrorMessage();
            }
            ?>
            <form class="form-signin" action="login.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Benutzer</p>
                <input type="text" id="inputEmail" class="login_box" name="username" placeholder="Benutzername" required
                       autofocus>
                <p class="input_title">Passwort</p>
                <input type="password" id="inputPassword" class="login_box" placeholder="******" name="password"
                       required>
                <button class="btn btn-lg btn-primary" type="submit" name="btn_anmelden">anmelden</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>