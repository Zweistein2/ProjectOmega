<!--
 * Created by PhpStorm.
 * Author: Sebastian Reuter, Thomas Wolf, Fabian Karolat
 * Date: 24.07.2017
 * Time: 13:24
 -->

<script>
    $(document).ready(function () {
        var currentPage = "";

        switch (location.pathname.substring(location.pathname.lastIndexOf("/") + 1)) {
            case "reporting.php":
                currentPage = "#" + "reporting";
                break;
            case "stammdaten_komponenten.php":
                currentPage = "#" + "stammdaten";
                break;
            case "stammdaten_komponentenarten.php":
                currentPage = "#" + "stammdaten";
                break;
            case "verwaltung_neuanlage.php":
                currentPage = "#" + "verwaltung";
                break;
            case "verwaltung_ausmusterung.php":
                currentPage = "#" + "verwaltung";
                break;
            case "help.php":
                currentPage = "#" + "hilfe";
                break;
        }

        $(currentPage).toggleClass("active");
    });
</script>
<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                require_once("../authentication/sessionhandler.php");
                if (strcmp(getUserGroupSession(), "Lehrer") !== 0) { ?>
                    <li class="dropdown" id="stammdaten">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stammdaten<span
                                class="caret"></span><span style="font-size:16px;"
                                                           class="pull-right hidden-xs showopacity glyphicon glyphicon-tag"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <?php
                        include_once("stammdaten.elements.php");
                        function loadComponents()
                        {
                            $dbElements = dbElements();
                            foreach ($dbElements as $i) {
                                $name = $i["NAME_PLURAL"];
                                $tableName = $i["TABLE_NAME"];
                                echo "<li><a href=\"./stammdaten_komponenten.php?type=$tableName\">$name</a></li>";
                            }
                        }

                        loadComponents();

                        ?>
                        <li><a href="./stammdaten_komponentenarten.php">Komponentenarten</a></li>
                    </ul>
                </li>
                    <li class="dropdown" id="verwaltung">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Verwaltung<span
                                class="caret"></span><span style="font-size:16px;"
                                                           class="pull-right hidden-xs showopacity glyphicon glyphicon-list"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="./verwaltung_neuanlage.php">Neuanlage</a></li>
                        <li><a href="./verwaltung_ausmusterung.php">Ausmusterung</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li id="reporting"><a href="./reporting.php">Reporting<span style="font-size:16px;"
                                               class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a>
                </li>
                <li id="hilfe"><a href="./help.php">Hilfe<span style="font-size:16px;"
                                                               class="pull-right hidden-xs showopacity glyphicon glyphicon-info-sign"></span></a>
                </li>
                <li><a href="./logout.php">Logout<span style="font-size:16px;"
                                                       class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>