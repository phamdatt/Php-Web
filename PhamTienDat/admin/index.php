<?php
session_start();
define('BASEPATH', true);
require_once('../system/core.php');
if (!isset($_SESSION["useradmin"])) {
    redirect('login.php');
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once('../Config.php');
require_once('../system/Database.php');
require_once('../system/load.php');
loadPage('ad');
