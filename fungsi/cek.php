<?php
//jika user belum login
if (isset($_SESSION['log'])) {
} else {
    $_SESSION['toastMessages'] = array("code_red", "Nah, Login First :)");
    header('location:login.php');
}