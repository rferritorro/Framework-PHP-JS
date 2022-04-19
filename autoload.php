<?php 
    require_once("paths.php");

    spl_autoload_extensions('.php,.inc.php,.class.php,.class.singleton.php');
    spl_autoload_register('loadClasses');

    function loadClasses() {

    };