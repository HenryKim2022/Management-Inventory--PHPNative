<?php
require_once(__DIR__ . '/../layouts/set_title.php');
require_once(__DIR__ . '/../fungsi/koneksi.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////


// <!-- QUERY ADD PARTS -->
if (isset($_POST['btnAddNewPart'])) {
    $tbPgref = 'mg_parts.php';
    $tbTxtref = 'Part';

    $nama_id = $_POST['addPartName'];
    $check = mysqli_query(
        $conn,
        "SELECT * FROM tb_part WHERE namapart = '$nama_id';"
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
                "INSERT INTO tb_part(namapart)
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
            "Plz fill *Part Name* field before saving :("
        );
        processIt($tbPgref, $toastMessages);
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////




//// <!-- QUERY DEL OUTCOMING -->
if (isset($_POST['act'])) {
    if (isset($_GET['partname'])) {
        $nama_id = $_GET['partname'];

        $checkPart = mysqli_query(
            $conn,
            "SELECT namapart FROM tb_part WHERE namapart IN (SELECT namapart FROM tb_stok)"
            // "SELECT tb_part.namapart 
            //     FROM tb_part.tb_part 
            //     WHERE tb_part.namapart 
            //     IN (SELECT tb_stok.namapart FROM tb_stok)"
        );
        if (mysqli_num_rows($checkPart) > 0) {
            echo "Part name is NOT available.";
            // unset($_SESSION["toastMessages"]);
            // $toastMessages = array(
            //     "code_yellow",
            //     "Plz fill $tbTxtref Name field before saving :("
            // );
            // processIt($tbPgref, $toastMessages);
        } else {
            // Part name is not used in tb_stok table
            echo "Part name is available.";
        }
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////



// <!-- QUERY DEL PARTS -->
if (isset($_GET['partname']) != 0) {
    $tbPgref = 'mg_parts.php';
    $tbTxtref = 'Part';

    $nama_id = $_GET['partname'];

    mysqli_query(     //// Check if in tb_stok namapart exist (linked)
        $conn,
        "SELECT namapart FROM tb_stok WHERE namapart = '$nama_id'"
    );


    if (mysqli_affected_rows($conn) > 0) {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_red",
            "Failed to delete Data $tbTxtref($nama_id). Part ($nama_id) is associated with tb_stok table!"
        );
        processIt($tbPgref, $toastMessages);
        ////
    } else {
        $deleteQuery = "DELETE FROM tb_part WHERE namapart = '$nama_id'";
        if (mysqli_query($conn, $deleteQuery)) {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_green",
                "Part($nama_id) successfully deleted :)"
            );
            processIt($tbPgref, $toastMessages);
            ////
        } else {
            echo "Error deleting part name: " . mysqli_error($conn);
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($nama_id) >" . mysqli_error($conn)
            );
            processIt($tbPgref, $toastMessages);
        }
    }
}



























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