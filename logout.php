<?php
// session_start();
require_once("fungsi/koneksi.php");

$_SESSION['log'] = 'false';
unset($_SESSION['log']);
session_destroy();

session_start();
$_SESSION['toastMessages'] = array("code_red", "Logged Out :)");

header('location:login.php');