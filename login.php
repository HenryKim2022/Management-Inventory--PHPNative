<?php
include("fungsi/koneksi.php");
$tbPgref = "login.php";

//cek akun
if (isset($_POST['login'])) {
    $NIK = $_POST['NIK'];
    $password = $_POST['password'];
    //pencocokan dengan database
    // $cekdatabase = mysqli_query($conn, "SELECT * FROM login where NIK='$NIK' and password='$password'");
    // $cekdatabase = mysqli_query(
    //     $conn,
    //     "SELECT * FROM tb_login where NIK='$NIK' and password='$password'
    // "
    // );

    $cekdatabase = mysqli_query(
        $conn,
        "SELECT tb_login.NIK, tb_login.login_status, tb_login.berlaku_sdtgl, tb_pegawai.nama_dpn, tb_pegawai.nama_blk, tb_level.user_level
        FROM tb_login
        INNER JOIN tb_pegawai ON tb_login.NIK = tb_pegawai.NIK
        INNER JOIN tb_level ON tb_login.user_level = tb_level.user_level
        WHERE tb_login.NIK = '$NIK' AND tb_login.password = '$password';   
        "
    );
    //hitung jumlah
    $hitung = mysqli_num_rows($cekdatabase);
    if ($hitung > 0) {
        $data = mysqli_fetch_all($cekdatabase, MYSQLI_ASSOC);
        $login_status = $data[0]['login_status'];
        $exp_status = $data[0]['berlaku_sdtgl'];

        if ($login_status == 'Allowed') {
            allowed_login();
        } elseif ($login_status == 'Blocked') {
            $_SESSION['toastMessages'][0] = "code_yellow";
            if (session_status() == PHP_SESSION_NONE) {
                session_start(); // Jika belum dimulai, mulai sesi
                $_SESSION['toastMessages'][1] = "UPS Sorry, your account has been blocked :(";
                echo "<script> window.location.href = 'login.php';</script>";
                exit();
            }
            $_SESSION['toastMessages'][1] = "UPS Sorry, your account has been blocked :(";
            echo "<script> window.location.href = 'login.php';</script>";
            exit();
        } else {
            if ($exp_status != '') {
                $currentDateTime = new DateTime();  // Current datetime
                $expirationDateTime = new DateTime($exp_status);  // Datetime from $exp_status
                // Compare the two datetimes
                if ($currentDateTime > $expirationDateTime) {
                    // echo "The expiration date has passed.";
                    $_SESSION['toastMessages'][0] = "code_yellow";
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start(); // Jika belum dimulai, mulai sesi
                        $_SESSION['toastMessages'][1] = "UPS Sorry, your account has expired :(";
                        echo "<script> window.location.href = 'login.php';</script>";
                        exit();
                    }
                    $_SESSION['toastMessages'][1] = "UPS Sorry, your account has expired :(";
                    echo "<script> window.location.href = 'login.php';</script>";
                    exit();
                } else {
                    // echo "The expiration date is still valid.";
                    allowed_login();
                }
            } else {
                $_SESSION['toastMessages'][0] = "code_red";
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); // Jika belum dimulai, mulai sesi
                    $_SESSION['toastMessages'][1] = "Sorry no Illegal Access :P";
                    echo "<script> window.location.href = 'login.php';</script>";
                    exit();
                }
                $_SESSION['toastMessages'][1] = "Sorry no Illegal Access :P";
                echo "<script> window.location.href = 'login.php';</script>";
                exit();
            }
        }
    } else {
        if (isset(($_SESSION["toastMessages"]))) {
            unset($_SESSION["toastMessages"]);
            $_SESSION['toastMessages'][0] = "code_red";
            if (session_status() == PHP_SESSION_NONE) {
                session_start(); // Jika belum dimulai, mulai sesi

                $_SESSION['toastMessages'][1] = "Wrong Login Credentials :(";
                echo "<script> window.location.href = '$tbPgref';</script>";
                exit();
            }
            $_SESSION['toastMessages'][1] = "Wrong Login Credentials :(";
            echo "<script> window.location.href = '$tbPgref';</script>";
            exit();
        } else {
            $_SESSION['toastMessages'][0] = "code_red";
            if (session_status() == PHP_SESSION_NONE) {
                session_start(); // Jika belum dimulai, mulai sesi
                $_SESSION['toastMessages'][1] = "Wrong Login Credentials :(";
                echo "<script> window.location.href = '$tbPgref';</script>";
                exit();
            }
            $_SESSION['toastMessages'][1] = "Wrong Login Credentials :(";
            echo "<script> window.location.href = '$tbPgref';</script>";
            exit();
        }

        // header('location:login.php');
        // exit();
    };
};

function allowed_login()
{
    global $NIK;
    global $cekdatabase;

    $_SESSION['log'] = 'true';
    $_SESSION['loggedin_nik'] = $NIK; // Username
    $_SESSION['userlvl'] = mysqli_fetch_assoc($cekdatabase)['user_level'];
    $_SESSION['toastMessages'] = array("code_green", "Welcome " . $_SESSION['userlvl'] . " :)");

    header('location:index.php');
    exit();
}

if (isset($_SESSION['log'])) {
    // header('location:index.php');
    echo "<script>
    window.location.replace('index.php');
    </script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="dist/css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>

</head>


<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <!-- TOAST -->
                    <?php include('toasts/login_page_toast.php') ?>

                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="NIK">NIK</label>
                                            <input class="form-control py-4" name="NIK" id="NIK" type="text"
                                                placeholder="Enter NIK" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" name="password" id="inputPassword"
                                                type="password" placeholder="Enter password" />
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>




    <?php require_once('layouts/js_bundle.php') ?>


</body>

</html>