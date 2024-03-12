<?php
require_once(__DIR__ . '/../layouts/set_title.php');
require_once(__DIR__ . '/../fungsi/koneksi.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////


// <!-- QUERY ADD USERLEVELS -->
if (isset($_POST['btnAddNewULogin'])) {
    $tbPgref = 'mg_ulogins.php';
    $tbTxtref = 'UserLogin';

    $nama_id = $_POST['addUserLoginNum'];
    $upass = $_POST['addUserLoginPass'];
    $ustat = $_POST['addUserLoginStatus'];
    $ulev = $_POST['addUserLoginLevel'];
    $ulexpdate = isset($_POST['userLoginExpDate']) ? $_POST['userLoginExpDate'] : null;

    if (!empty($nama_id)) {
        if (!empty($upass)) {
            if (!empty($ulev)) {
                if (!empty($ustat)) {
                    $check = mysqli_query($conn, "SELECT * FROM tb_login WHERE NIK = '$nama_id';");

                    if (mysqli_num_rows($check) > 0) {
                        unset($_SESSION["toastMessages"]);
                        $toastMessages = array(
                            "code_yellow",
                            "Data $tbTxtref($nama_id) already exists!"
                        );
                        processIt($tbPgref, $toastMessages);
                    } else {
                        $berlaku_sdtgl = !empty($ulexpdate) ? date('Y-m-d H:i:s', strtotime($ulexpdate)) : NULL;
                        if ($berlaku_sdtgl == NULL || $berlaku_sdtgl == "") {
                            $result = mysqli_query($conn, "INSERT INTO tb_login(password, login_status, berlaku_sdtgl, NIK, user_level) VALUES ('$upass','$ustat',NULL,'$nama_id','$ulev');");
                            if (mysqli_affected_rows($conn) > 0) {
                                unset($_SESSION["toastMessages"]);
                                $toastMessages = array(
                                    "code_green",
                                    "Data $tbTxtref($nama_id) added successfully :)"
                                );
                                processIt($tbPgref, $toastMessages);
                            } else {
                                unset($_SESSION["toastMessages"]);
                                $toastMessages = array(
                                    "code_red",
                                    "Err: Failed to add Data $tbTxtref($nama_id) :("
                                );
                                processIt($tbPgref, $toastMessages);
                            }
                        } else {
                            $result = mysqli_query($conn, "INSERT INTO tb_login(password, login_status, berlaku_sdtgl, NIK, user_level) VALUES ('$upass','$ustat','$berlaku_sdtgl','$nama_id','$ulev');");
                            if (mysqli_affected_rows($conn) > 0) {
                                unset($_SESSION["toastMessages"]);
                                $toastMessages = array(
                                    "code_green",
                                    "Data $tbTxtref($nama_id) added successfully :)"
                                );
                                processIt($tbPgref, $toastMessages);
                            } else {
                                unset($_SESSION["toastMessages"]);
                                $toastMessages = array(
                                    "code_red",
                                    "Err: Failed to add Data $tbTxtref($nama_id) :("
                                );
                                processIt($tbPgref, $toastMessages);
                            }
                        }
                    }
                } else {
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_yellow",
                        "Please set the Account Status before saving :("
                    );
                    processIt($tbPgref, $toastMessages);
                }
            } else {
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_yellow",
                    "Please set the Level before saving :("
                );
                processIt($tbPgref, $toastMessages);
            }
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_yellow",
                "Please set the Password Field before saving :("
            );
            processIt($tbPgref, $toastMessages);
        }
    } else {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Please select an Employee before saving :("
        );
        processIt($tbPgref, $toastMessages);
    }
}
///////


/////////////////////////////////////////////////////////////////////////////////////////////////////




// <!-- QUERY DEL USERLOGIN -->
if (isset($_GET['unik']) != 0) {
    $tbPgref = 'mg_ulogins.php';
    $tbTxtref = 'UserLogin';
    $ulogin_fullname = "";


    $login_unik = $_GET['unik'];

    $pegawaiData = mysqli_query(     //// Check if in tb_pegawai id_divisi exist (linked)
        $conn,
        "SELECT tb_pegawai.NIK, CONCAT(tb_pegawai.nama_dpn, ' ', tb_pegawai.nama_blk) AS namalengkap
        FROM tb_pegawai
        WHERE tb_pegawai.NIK = '$login_unik';
        "
    );
    $data = mysqli_fetch_all($pegawaiData, MYSQLI_ASSOC);
    $ulogin_fullname = $data[0]['namalengkap'];
    $nik2process =  $data[0]['NIK'];


    if (mysqli_affected_rows($conn) > 0) {
        $deleteQuery = mysqli_query(     //// TRY DELETING
            $conn,
            "DELETE FROM tb_login WHERE NIK = $nik2process;"
        );

        if (mysqli_affected_rows($conn) > 0) {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_green",
                "Data $tbTxtref($ulogin_fullname) delete successfully :)"
            );
            processIt($tbPgref, $toastMessages);
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($ulogin_fullname)   :("
            );
            processIt($tbPgref, $toastMessages);
        }

        ////
    } else {
        // echo "BIARIN";
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Failed to delete Data $tbTxtref($ulogin_fullname). $tbTxtref($ulogin_fullname) is associated with tb_pegawai table!"
        );
        processIt($tbPgref, $toastMessages);
        ////
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////















/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////   CORE   //////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
class PBO
{
    public function setSessionValuesAndRedirect($tbPgref, $toastMessages)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($toastMessages) && is_array($toastMessages)) {
            $_SESSION['toastMessages'] = $toastMessages;
            return true;
        } else {
            return false;
        }
    }
}


function processIt($tbPgref, $toastMessages)
{
    $pbo = new PBO();
    $result = $pbo->setSessionValuesAndRedirect($tbPgref, $toastMessages);

    if ($result === true) {
        echo "<script>console.log('$tbPgref');</script>";
        // echo "<script>window.location.href = 'mg_st.php';</script>";
        if (isset($_GET['js']) != '') {
            $tbPgref = 'logout.php';
            echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
        } else {
            echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
        }
    } elseif ($result === false) {
        echo "<script>console.log('Invalid Data !');</script>";
        // echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
    }
}