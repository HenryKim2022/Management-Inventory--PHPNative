<?php
$baseUrl = $_SERVER['HTTP_HOST'] . '/';
// $url = parse_url($_SERVER['SERVER_NAME'], PHP_URL_HOST);

$app_name = "Inventory Management";
// $app_domain = "http://localhost";
$app_domain = "https://cobra-crucial-cardinal.ngrok-free.app";
$institution_name = "Institut Teknologi Indonesia";
$app_purpose = "Information System Projects";
$group_members = array(
    array('Henry .K', '(1152125001)')
);




$toastMsg = "";


$noDasbhoardTB = True;

// SET PG.TITLE
$pg_title = "";
$tbTxtref = "";
$tbPgref = "";
$currentUrl = $_SERVER['REQUEST_URI'];
if (strpos($currentUrl, 'index.php') !== false) {
    $pg_title = "Dashboard";
    $tbTxtref = "Dashboard";
    $tbPgref = "index.php";
} else if (strpos($currentUrl, 'mg_st.php') !== false) {
    $pg_title = "List of Goods Stocks";
    $tbTxtref = "Stock";
    $tbPgref = "mg_st.php";
} else if (strpos($currentUrl, 'mg_in.php') !== false) {
    $pg_title = "List of Incoming Goods";
    $tbTxtref = "Goods";
    $tbPgref = "mg_in.php";
} else if (strpos($currentUrl, 'mg_out.php') !== false) {
    $pg_title = "List of Outcoming Goods";
    $tbTxtref = "Goods";
    $tbPgref = "mg_out.php";
} else if (strpos($currentUrl, 'mg_goods.php') !== false) {
    $pg_title = "List of Goods";
    $tbTxtref = "Goods";
    $tbPgref = "mg_goods.php";
} else if (strpos($currentUrl, 'mg_parts.php') !== false) {
    $pg_title = "List of Parts";
    $tbTxtref = "Part";
    $tbPgref = "mg_parts.php";
} else if (strpos($currentUrl, 'mg_empl.php') !== false) {
    $pg_title = "List of Employee";
    $tbTxtref = "Employee";
    $tbPgref = "mg_empl.php";
} else if (strpos($currentUrl, 'mg_div.php') !== false) {
    $pg_title = "List of Divisions";
    $tbTxtref = "Division";
    $tbPgref = "mg_div.php";
} else if (strpos($currentUrl, 'mg_ulogins.php') !== false) {
    $pg_title = "List of UserLogins";
    $tbTxtref = "UserLogin";
    $tbPgref = "mg_ulogins.php";
} else if (strpos($currentUrl, 'mg_ulev.php') !== false) {
    $pg_title = "List of UserLevels";
    $tbTxtref = "UserLevel";
    $tbPgref = "mg_ulev.php";
} else if (strpos($currentUrl, 'mg_blulogins.php') !== false) {
    $pg_title = "List of Blocked UserLogins";
    $tbTxtref = "UserLogin";
    $tbPgref = "mg_blulogins.php";
}

$desiredPath = $tbPgref;
$redirectUrl = $baseUrl . $desiredPath;