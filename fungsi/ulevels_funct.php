<?php
require_once(__DIR__ . '/../layouts/set_title.php');
require_once(__DIR__ . '/../fungsi/koneksi.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////


// <!-- QUERY ADD USERLEVELS -->
if (isset($_POST['btnAddNewUlev'])) {
    $tbPgref = 'mg_ulev.php';
    $tbTxtref = 'UserLevel';

    $nama_id = $_POST['addUlevName'];
    $check = mysqli_query(
        $conn,
        "SELECT * FROM tb_level WHERE user_level = '$nama_id';"
    );

    if ($nama_id != '') {
        ///////// If there is a record, display an alert 
        if (mysqli_num_rows($check) > 0) {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_yellow",
                "Data $tbTxtref($nama_id) already exists!"
            );
            processIt($tbPgref, $toastMessages);
        } else {
            $result = mysqli_query(
                $conn,
                "INSERT INTO tb_level(user_level)
                    VALUES ('$nama_id');"
            );
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
        ///////
    } else {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Plz at least fill $tbTxtref field before saving :("
        );
        processIt($tbPgref, $toastMessages);
    };
    ///////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////




// <!-- QUERY DEL USERLEVEL -->
if (isset($_GET['usrname']) != 0) {
    $tbPgref = 'mg_ulev.php';
    $tbTxtref = 'UserLevel';

    $user_level = $_GET['usrname'];


    mysqli_query(     //// Check if in tb_pegawai id_divisi exist (linked)
        $conn,
        "SELECT user_level FROM tb_login WHERE user_level = '$user_level'"
    );

    // $getDivName =  mysqli_query(     //// Check Division Name by $div_id
    //     $conn,
    //     "SELECT nama_div FROM tb_divisi WHERE id_divisi = '$div_id'"
    // );
    // $data = mysqli_fetch_all($getDivName, MYSQLI_ASSOC);
    // $nama_div = $data[0]['nama_div'];


    if (mysqli_affected_rows($conn) > 0) {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Failed to delete Data $tbTxtref($user_level). UserLevel($user_level) is associated with tb_login table!"
        );
        processIt($tbPgref, $toastMessages);
        ////
    } else {
        $deleteQuery = "DELETE FROM tb_level WHERE user_level = '$user_level'";
        if (mysqli_query($conn, $deleteQuery)) {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_green",
                "$tbTxtref($user_level) successfully deleted :)"
            );
            processIt($tbPgref, $toastMessages);
            ////
        } else {
            echo "Error deleting UserLevel: " . mysqli_error($conn);
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($user_level) >" . mysqli_error($conn)
            );
            processIt($tbPgref, $toastMessages);
        }
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
        echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
    } elseif ($result === false) {
        echo "<script>console.log('Invalid Data !');</script>";
        // echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
    }
}