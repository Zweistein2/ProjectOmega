<!--
 * Created by PhpStorm.
 * Author: Sebastian Reuter, Thomas Wolf
 * Date: 24.07.2017
 * Time: 13:24
 -->
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
                <!--<li class="active"><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stammdaten<span
                                class="caret"></span><span style="font-size:16px;"
                                                           class="pull-right hidden-xs showopacity glyphicon glyphicon-tag"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">Lieferanten</a></li>
                        <li><a href="#">Räume</a></li>
                        <li><a href="#">Benutzer</a></li>
                        <li><a href="#">Komponentenarten</a></li>
                        <li><a href="#">Komponentenattribute</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Verwaltung<span
                                class="caret"></span><span style="font-size:16px;"
                                                           class="pull-right hidden-xs showopacity glyphicon glyphicon-list"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">Neu</a></li>
                        <li><a href="#">Ausmusterung</a></li>
                    </ul>
                </li>
                <li><a href="#">Reporting<span style="font-size:16px;"
                                               class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a>
                </li>
                <li><a href="#">Logout<span style="font-size:16px;"
                                            class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>