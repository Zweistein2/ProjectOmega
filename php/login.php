<!--
 * Created by PhpStorm.
 * Author: Sebastian Reuter, Thomas Wolf
 * Date: 24.07.2017
 * Time: 14:10
 -->
<html>
<head>
<meta charset="utf-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <?php
    //include("template/head.template.php");
    ?>
</head>
<?php
//include("template/sidebar.template.php");
?>
<div class="container">
    <div class="container">

        <div class="card card-container">
            <h2 class='login_title text-center'>Anmeldung</h2>
            <hr>

            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Email</p>
                <input type="text" id="inputEmail" class="login_box" placeholder="verwaltung@b3-fuerth.de" required autofocus>
                <p class="input_title">Passwort</p>
                <input type="password" id="inputPassword" class="login_box" placeholder="******" required>
                <div id="remember" class="checkbox">
                    <label>

                    </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit">Login</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</div>
</html>


