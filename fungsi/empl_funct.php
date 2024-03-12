<?php
require_once(__DIR__ . '/../layouts/set_title.php');
require_once(__DIR__ . '/../fungsi/koneksi.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////


// <!-- QUERY ADD PARTS -->
if (isset($_POST['btnAddNewEmployee'])) {
    $tbPgref = 'mg_empl.php';
    $tbTxtref = 'Employee';
    $EmpFullName = "";

    $EmpID = $_POST['addEmployeeID'];
    $Fname = $_POST['addEmployeeFName'];
    $Bname = $_POST['addEmployeeLName'];
    $DomAddr = $_POST['addEmployeeDomAddr'];
    $IntoDiv = $_POST['addEmployeeIntoDiv'];



    $check = mysqli_query(
        $conn,
        "SELECT * FROM tb_pegawai WHERE NIK = '$EmpID';"
    );
    $data = mysqli_fetch_all($check, MYSQLI_ASSOC);


    if ($Bname != '') {
        $EmpFullName = $Fname . ' ' . $Bname;
    } else {
        $EmpFullName = $Fname;
    }

    if ($EmpID != '') {
        if ($Fname != '') {
            if ($DomAddr != '') {
                if ($IntoDiv != '') {
                    ///////// If there is a record, display an alert 
                    if (mysqli_num_rows($check) > 0) {
                        unset($_SESSION["toastMessages"]);
                        $toastMessages = array(
                            "code_yellow",
                            "Data $tbTxtref($EmpFullName) already exists!"
                        );
                        processIt($tbPgref, $toastMessages);
                    } else {
                        $result = mysqli_query(
                            $conn,
                            "INSERT INTO tb_pegawai (NIK, nama_dpn, nama_blk, alamat_dom, id_divisi)
                                VALUES
                                ('$EmpID','$Fname','$Bname','$DomAddr','$IntoDiv');
                            "
                        );
                        if (mysqli_affected_rows($conn) > 0) {
                            unset($_SESSION["toastMessages"]);
                            $toastMessages = array(
                                "code_green",
                                "Data $tbTxtref($EmpFullName) added successfully :)"
                            );
                            processIt($tbPgref, $toastMessages);
                        } else {
                            unset($_SESSION["toastMessages"]);
                            $toastMessages = array(
                                "code_red",
                                "Err: Failed to add Data $tbTxtref($EmpFullName) :("
                            );
                            processIt($tbPgref, $toastMessages);
                        }
                    }
                    ///////
                } else {
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_yellow",
                        "Plz select *$tbTxtref Division* before saving :("
                    );
                    processIt($tbPgref, $toastMessages);
                }
            } else {
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_yellow",
                    "Plz at least fill *$tbTxtref ResidentAddr* field before saving :("
                );
                processIt($tbPgref, $toastMessages);
            }
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_yellow",
                "Plz at least fill *$tbTxtref Firstname* field before saving :("
            );
            processIt($tbPgref, $toastMessages);
        }
    } else {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Plz fill *$tbTxtref NIK* field before saving :("
        );
        processIt($tbPgref, $toastMessages);
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////






// <!-- QUERY DEL EMPLOYEE -->
$redirect = false;
if (isset($_GET['empnik']) && !empty($_GET['empnik']) && isset($_GET['act']) && !empty($_GET['act']) && !empty($_GET['act']) == 'del') {
    $tbPgref = 'mg_empl.php';
    $tbTxtref = 'Employee';
    $getEmpFullName = "";


    $employee_id = $_GET['empnik'];

    $empData = mysqli_query(     //// Check if in tb_pegawai id_divisi exist (linked)
        $conn,
        "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn AS REF_OUTPUT1, tb_pegawai.nama_blk AS REF_OUTPUT2,
        tb_login.*, tb_br_in.*,  tb_br_out.*
        FROM tb_pegawai 
        LEFT JOIN tb_login ON tb_pegawai.NIK = tb_login.NIK
        LEFT JOIN tb_br_in ON tb_pegawai.NIK = tb_br_in.NIK
        LEFT JOIN tb_br_out ON tb_pegawai.NIK = tb_br_out.NIK
        WHERE tb_pegawai.NIK = '$employee_id'"
    );

    $getEmpData = mysqli_fetch_all($empData, MYSQLI_ASSOC);
    if (!empty($getEmpData)) {
        $getEmpFName = $getEmpData[0]['REF_OUTPUT1'];
        $getEmpBName = $getEmpData[0]['REF_OUTPUT2'];
        if ($getEmpBName != '') {
            $getEmpFullName =  $getEmpFName . ' ' .  $getEmpBName;
        } else {
            $getEmpFullName =  $getEmpFName;
        }
        // Rest of your code
    } else {
        // Handle the case when no rows are returned
    }



    $checkLogin = mysqli_query(
        $conn,
        "SELECT * FROM tb_login WHERE NIK = '$employee_id'"
    );

    if (mysqli_num_rows($checkLogin) > 0) {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Failed to delete Data $tbTxtref($getEmpFullName). $tbTxtref($getEmpFullName) is associated with tb_login table!"
        );
        processIt($tbPgref, $toastMessages);
    } else {

        $deleteQuery = "DELETE FROM tb_pegawai WHERE NIK = '$employee_id'";
        if (mysqli_query($conn, $deleteQuery)) {
            // if (mysqli_num_rows($checkLogin) > 0) {
            $redirect = true;

            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_green",
                "$tbTxtref($getEmpFullName) successfully deleted :)"
            );
            processIt($tbPgref, $toastMessages);
            // } else {
            //     unset($_SESSION["toastMessages"]);
            //     $toastMessages = array(
            //         "code_red",
            //         "Err: The query was success, but failed to delete Data $tbTxtref($getEmpFullName) >" . mysqli_error($conn)
            //     );
            //     processIt($tbPgref, $toastMessages);
            // }
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($getEmpFullName) >" . mysqli_error($conn)
            );
            processIt($tbPgref, $toastMessages);
        }
        // }
        // }
    }




    // $check = mysqli_query(     //// Check if in tb_pegawai id_divisi exist (linked)
    //     $conn,
    //     "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn AS REF_OUTPUT1, tb_pegawai.nama_blk AS REF_OUTPUT2,
    //     tb_divisi.*
    //     FROM tb_pegawai 
    //     LEFT JOIN tb_divisi ON tb_pegawai.id_divisi = tb_divisi.id_divisi
    //     WHERE tb_pegawai.NIK = '$employee_id'"
    // );

    // if ((mysqli_affected_rows($conn) > 0)) {
    //     unset($_SESSION["toastMessages"]);
    //     $toastMessages = array(
    //         "code_yellow",
    //         // "Failed to delete Data $tbTxtref($getEmpFullName). $tbTxtref($getEmpFullName) is associated with tb_login table!"
    //         "Failed to delete Data $tbTxtref($getEmpFullName)." . mysqli_error($conn)
    //     );
    //     processIt($tbPgref, $toastMessages);
    //     ////
    // } else {
    //     $deleteQuery = "DELETE FROM tb_pegawai WHERE tb_pegawai.NIK = '$employee_id'";
    //     if (mysqli_query($conn, $deleteQuery)) {
    //         unset($_SESSION["toastMessages"]);
    //         $toastMessages = array(
    //             "code_green",
    //             "$tbTxtref($getEmpFullName) successfully deleted :)"
    //         );
    //         processIt($tbPgref, $toastMessages);
    //         ////
    //     } else {
    //         unset($_SESSION["toastMessages"]);
    //         $toastMessages = array(
    //             "code_red",
    //             "Err: Failed to delete Data $tbTxtref($getEmpFullName) >" . mysqli_error($conn)
    //         );
    //         processIt($tbPgref, $toastMessages);
    //     }
    // }
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
    global $redirect;
    $pbo = new PBO();
    $result = $pbo->setSessionValuesAndRedirect($tbPgref, $toastMessages);

    if ($result === true) {
        echo "<script>console.log('$tbPgref');</script>";
        if (isset($_GET['js']) != '') {
            if (isset($_GET['empnik'])) {
                echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
            } else if ($redirect == true && isset($_GET['empnik'])) {
                $tbPgref = 'logout.php';
                echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
            } else {
                $tbPgref = 'logout.php';
                echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
            }
        } else {
            echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
        }
    } elseif ($result === false) {
        echo "<script>console.log('Invalid Data !');</script>";
        // echo "<script>window.location.href = '" . dirname($_SERVER['PHP_SELF']) . "/../" . $tbPgref . "';</script>";
    }
}