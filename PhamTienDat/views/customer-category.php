<?php
if (isset($_REQUEST['cat'])) {
    $cat = $_REQUEST['cat'];
    if ($cat == 'login') {
        require_once('views/customer-login.php');
    } elseif ($cat == 'logout') {
        unset($_SESSION['user_customer']);
        unset($_SESSION['fullname_customer']);
        redirect('index.php');
    } elseif ($cat == 'register') {
        require_once('views/customer-register.php');
    } else {
        redirect('index.php');
    }
}
