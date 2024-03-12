<?php
require_once(__DIR__ . '/../layouts/set_title.php');
require_once(__DIR__ . '/../fungsi/koneksi.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////

//// <!-- QUERY ADD STOCKS -->
if (isset($_POST['btnAddNewStock'])) {
    $tbPgref = 'mg_st.php';
    $tbTxtref = 'Stock';

    $nama_id = $_POST['addStockPartID'];
    $qty = $_POST['qtyStockIn'];

    $check = mysqli_query(
        $conn,
        "SELECT * 
            FROM tb_stok 
            INNER JOIN tb_part ON tb_stok.namapart = tb_part.namapart
            WHERE tb_stok.namapart = '$nama_id';"
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

            ///////
        } else { // If there is no record, add it to the database 
            $result = mysqli_query(
                $conn,
                "INSERT INTO tb_stok(jmlh_ttl, namapart)
                VALUES ('$qty','$nama_id');"
            );
            if (mysqli_affected_rows($conn) > 0) {

                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_green",
                    "Data $tbTxtref($nama_id) added successfully :)"
                );
                processIt($tbPgref, $toastMessages);
            } else {
                //unset($_SESSION["toastMessages"]);
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_red",
                    "Err: Failed to add Data $tbTxtref($nama_id) >" . mysqli_error($conn)
                );
                processIt($tbPgref, $toastMessages);
            }
        }
        //////
    } else {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Plz select *PartID* before saving :("
        );
        processIt($tbPgref, $toastMessages);
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////



// <!-- QUERY DEL GOODS STOCK -->
if (isset($_GET['stock_id']) && !empty($_GET['stock_id']) && isset($_GET['act']) && !empty($_GET['act']) && !empty($_GET['act']) == 'del') {
    $tbPgref = 'mg_st.php';
    $tbTxtref = 'GoodsStock';
    $getGoodStockPartName = "";

    $stock_id = $_GET['stock_id'];


    ////    CONVERT id_stockbarang to partname (DOWN)
    $IDIncomming2PARTNAME = mysqli_query(
        $conn,
        "SELECT tb_stok.id_stockbarang, tb_stok.id_stockbarang, tb_stok.namapart AS REF_OUTPUT,
        tb_br_in.id_stockbarang, tb_br_out.id_stockbarang
        FROM tb_stok
        INNER JOIN tb_br_in ON tb_stok.id_stockbarang = tb_br_in.id_stockbarang
        INNER JOIN tb_br_out ON  tb_stok.id_stockbarang = tb_br_out.id_stockbarang
        WHERE tb_stok.id_stockbarang = '$stock_id';
        "
    );

    if ($IDIncomming2PARTNAME) {
        $getStockData = mysqli_fetch_all($IDIncomming2PARTNAME, MYSQLI_ASSOC);
        if (!empty($getStockData)) {
            $getGoodStockPartName = $getStockData[0]['REF_OUTPUT'];
            // Rest of your code
        } else {
            // Handle the case when no rows are returned
        }
    } else {
        // Handle the case when the query fails
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_red",
            "Err: Failed to check Data $tbTxtref($getGoodStockPartName) >" . mysqli_error($conn)
        );
        processIt($tbPgref, $toastMessages);
    }


    $check = mysqli_query(     //// Check if in tb_pegawai id_divisi exist (linked)
        $conn,
        "SELECT tb_br_in.*, tb_br_out.*, tb_stok.id_stockBarang AS REF_OUTPUT
        FROM tb_br_in 
        LEFT JOIN tb_br_out ON tb_br_in.id_stockbarang = tb_br_out.id_stockbarang
        LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
        WHERE tb_br_in.id_stockbarang = '$stock_id'"
    );


    if ((mysqli_affected_rows($conn) > 0)) {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Failed to delete Data $tbTxtref($getGoodStockPartName). $tbTxtref($getGoodStockPartName) is associated with tb_br_in or tb_br_out table!"
        );
        processIt($tbPgref, $toastMessages);
        ////
    } else {
        $deleteQuery = "DELETE FROM tb_stok WHERE id_stockbarang = '$stock_id'";
        if (mysqli_query($conn, $deleteQuery)) {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_green",
                "$tbTxtref($getGoodStockPartName) successfully deleted :)"
            );
            processIt($tbPgref, $toastMessages);
            ////
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($getGoodStockPartName) >" . mysqli_error($conn)
            );
            processIt($tbPgref, $toastMessages);
        }
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////





//// <!-- QUERY ADD INCOMING -->
if (isset($_POST['btnAddNewIncoming'])) {
    $tbPgref = 'mg_in.php';
    $tbTxtref = 'IncomingGoods';

    ////    RECEIVED RESPONSE
    $nama_id = $_POST['addIncomingPartID'];
    $qty = $_POST['qtyGoodsIn'];
    $pic = $_POST['AddPICInNum'];
    $rec_date = $_POST['incomingDate'];
    ////    CHECK IF STOCK AVAILABLE
    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM tb_stok;"
    );


    if ($nama_id != '') {
        if ($qty != '') {
            if ($pic != '') {
                if ($rec_date != '') {
                    ///////// If there is a record in TB_STOK, display an alert 
                    if (mysqli_num_rows($check) > 0) {
                        ////    INSERT INCOMING DATA INTO BRIN
                        $INSERT_BRIN = mysqli_query(
                            $conn,
                            "INSERT INTO tb_br_in(tanggal, jmlh, NIK, id_stockbarang)
                            VALUES ('$rec_date', $qty, '$pic', $nama_id)"
                        );
                        ////    CONVERT id_stockbarang to partname (DOWN)
                        $IDStock2PARTNAME = mysqli_query(
                            $conn,
                            "SELECT tb_br_in.id_brin, tb_br_in.tanggal, tb_br_in.jmlh, tb_br_in.id_stockbarang, 
                            tb_br_in.updated_at, tb_br_in.NIK, tb_stok.namapart
                            FROM tb_br_in
                            INNER JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            INNER JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            WHERE tb_br_in.id_stockbarang = '$nama_id'; 
                            "
                        );
                        $data = mysqli_fetch_all($IDStock2PARTNAME, MYSQLI_ASSOC);
                        ////    CONVERT id_stockbarang to partname (UP)
                        $partname = $data[0]['namapart'];
                        if ($IDStock2PARTNAME) {
                            $UPT_STOCK = mysqli_query(
                                $conn,
                                "UPDATE tb_stok
                                SET jmlh_ttl = jmlh_ttl + (
                                    SELECT SUM(jmlh) AS total_jmlh
                                    FROM (
                                        SELECT jmlh
                                        FROM tb_br_in
                                        WHERE id_stockbarang = (
                                            SELECT id_stockbarang
                                            FROM tb_stok
                                            WHERE namapart = '$partname'
                                        )
                                        ORDER BY id_brin DESC
                                        LIMIT 1
                                    ) AS latest_br_in
                                )
                                WHERE namapart = '$partname';"
                            );
                            ////    TOAST MSG: SUCCESS to CONV id_stockbarang to partname
                            unset($_SESSION["toastMessages"]);
                            $toastMessages = array(
                                "code_green",
                                "Data $tbTxtref($partname) saved :)"
                            );
                            processIt($tbPgref, $toastMessages);
                            //
                        } else {
                            ////    TOAST MSG: FAILED to CONV id_stockbarang to partname
                            unset($_SESSION["toastMessages"]);
                            $toastMessages = array(
                                "code_red",
                                "Failed to convert id_stockbarang to partname :(!"
                            );
                            processIt($tbPgref, $toastMessages);
                            //
                        }
                    } else {
                        ////     TOAST MSG: CHECK tb_stok availability
                        unset($_SESSION["toastMessages"]);
                        $toastMessages = array(
                            "code_red",
                            "There's no stock available on Table Stock!"
                        );
                        processIt($tbPgref, $toastMessages);
                        //
                    }
                    ///////
                } else {
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_yellow",
                        "Plz select *Incoming Date* before saving :("
                    );
                    processIt($tbPgref, $toastMessages);
                }
            } else {
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_yellow",
                    "Plz select *PIC* before saving :("
                );
                processIt($tbPgref, $toastMessages);
            }
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_yellow",
                "Plz fill *Quantity* before saving :("
            );
            processIt($tbPgref, $toastMessages);
        }
    } else {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Plz select *Goods PartName* before saving :("
        );
        processIt($tbPgref, $toastMessages);
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////




// <!-- QUERY DEL INCOMING GOODS -->
if (isset($_GET['brin_id']) && !empty($_GET['brin_id']) && isset($_GET['return_qty']) && !empty($_GET['return_qty'])) {
    $tbPgref = 'mg_in.php';
    $tbTxtref = 'IncomingGoods';

    $brin_id = $_GET['brin_id'];
    $returned_qty = $_GET['return_qty'];


    ////    CONVERT id_stockbarang to partname (DOWN)
    $IDIncomming2PARTNAME = mysqli_query(
        $conn,
        "SELECT tb_br_in.id_brin, tb_br_in.id_stockbarang, tb_stok.namapart, 
        tb_stok.id_stockbarang AS REF_OUTPUT
        FROM tb_br_in
        INNER JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
        INNER JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
        WHERE tb_br_in.id_brin = '$brin_id';
        "
    );
    ////    CONVERT id_stockbarang to partname (UP)
    $getIncommingData = mysqli_fetch_all($IDIncomming2PARTNAME, MYSQLI_ASSOC);
    $getGoodStockId = $getIncommingData[0]['REF_OUTPUT'];

    if (!empty($getGoodStockId)) {
        // var_dump($brin_id);
        // $deleteQuery = "DELETE FROM tb_br_in WHERE id_brin = '$brin_id'";
        $deleteQuery = "DELETE FROM tb_br_in WHERE id_brin = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $brin_id);
        if ($stmt->execute()) {

            // var_dump($getGoodStockId);
            $updateQuery = mysqli_query($conn, "UPDATE tb_stok
                SET tb_stok.jmlh_ttl = tb_stok.jmlh_ttl - $returned_qty
                WHERE tb_stok.id_stockbarang = '$getGoodStockId'");
            if ($updateQuery) {
                $affectedRows = mysqli_affected_rows($conn);
                if ($affectedRows > 0) {
                    // echo "Update query executed successfully. $affectedRows row(s) affected.";
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_green",
                        "$tbTxtref($brin_id) successfully deleted :)"
                    );
                    processIt($tbPgref, $toastMessages);
                } else {
                    // echo "Update query executed successfully, but no rows were affected.";
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_yellow",
                        "$tbTxtref($brin_id) failed to delete :("
                    );
                    processIt($tbPgref, $toastMessages);
                }
            } else {
                echo "Error executing the update query: " . mysqli_error($conn);
                echo "Error deleting Incoming Record: " . mysqli_error($conn);
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_red",
                    "Err: Failed to update tb_stok.jmlh_ttl >" . mysqli_error($conn)
                );
                processIt($tbPgref, $toastMessages);
            }
        } else {
            echo "Error deleting Incoming Record: " . mysqli_error($conn);
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($brin_id) >" . mysqli_error($conn)
            );
            processIt($tbPgref, $toastMessages);
        }
    } else {
        // Handle the case when no rows are returned
        ////    TOAST MSG: FAILED to CONV id_stockbarang to partname
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_red",
            "Failed to convert id_stockbarang to partname. id_stockbarang not found :("
        );
        processIt($tbPgref, $toastMessages);
        //
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////










//// <!-- QUERY ADD OUTCOMING -->
if (isset($_POST['btnAddNewOutcoming'])) {
    $tbPgref = 'mg_out.php';
    $tbTxtref = 'Outcoming Goods';

    ////    RECEIVED RESPONSE
    $nama_id = $_POST['addOutcomingPartID'];
    $qty = $_POST['qtyGoodsOut'];
    $pic = $_POST['AddPICOutNum'];
    $rec_date = $_POST['outcomingDate'];
    ////    CHECK IF STOCK AVAILABLE
    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM tb_stok;"
    );

    if ($nama_id != '') {
        if ($qty != '') {
            if ($pic != '') {
                if ($rec_date != '') {
                    ///////// If there is a record in TB_STOK, display an alert 
                    if (mysqli_num_rows($check) > 0) {
                        ////    INSERT INCOMING DATA INTO BRIN
                        $INSERT_BRIN = mysqli_query(
                            $conn,
                            "INSERT INTO tb_br_out(tanggal, jmlh, NIK, id_stockbarang)
                                VALUES ('$rec_date', $qty, '$pic', $nama_id)"
                        );
                        ////    CONVERT id_stockbarang to partname (DOWN)
                        $IDStock2PARTNAME = mysqli_query(
                            $conn,
                            "SELECT tb_br_out.id_brout, tb_br_out.tanggal, tb_br_out.jmlh, tb_br_out.id_stockbarang, 
                            tb_br_out.updated_at, tb_br_out.NIK, tb_stok.namapart
                            FROM tb_br_out
                            INNER JOIN tb_pegawai ON tb_br_out.NIK = tb_pegawai.NIK
                            INNER JOIN tb_stok ON tb_br_out.id_stockbarang = tb_stok.id_stockbarang
                            WHERE tb_br_out.id_stockbarang = '$nama_id'; 
                            "
                        );
                        ////    CONVERT id_stockbarang to partname (UP)
                        $data = mysqli_fetch_all($IDStock2PARTNAME, MYSQLI_ASSOC);
                        $partname = $data[0]['namapart'];
                        if ($IDStock2PARTNAME) {
                            // Create temporary table
                            $createTempTableQuery = "CREATE TEMPORARY TABLE temp_br_out AS (
                                                        SELECT jmlh, id_stockbarang
                                                        FROM tb_br_out
                                                        WHERE id_stockbarang = (
                                                            SELECT id_stockbarang
                                                            FROM tb_stok
                                                            WHERE namapart = '$partname'
                                                        )
                                                        ORDER BY id_brout DESC
                                                        LIMIT 1
                                                    )";
                            $createTempTableResult = mysqli_query($conn, $createTempTableQuery);

                            if ($createTempTableResult) {
                                /// Perform the update
                                $updateQuery = "UPDATE tb_stok
                                                    JOIN temp_br_out ON tb_stok.id_stockbarang = temp_br_out.id_stockbarang
                                                    SET tb_stok.jmlh_ttl = tb_stok.jmlh_ttl - temp_br_out.jmlh
                                                    WHERE tb_stok.namapart = '$partname'";
                                $updateResult = mysqli_query($conn, $updateQuery);

                                /// Drop the temporary table
                                $dropTempTableQuery = "DROP TEMPORARY TABLE IF EXISTS temp_br_out";
                                $dropTempTableResult = mysqli_query($conn, $dropTempTableQuery);

                                /////// Check if all queries executed successfully
                                if ($updateResult && $dropTempTableResult) {
                                    /// TOAST MSG: SUCCESS to CONV id_stockbarang to partname
                                    unset($_SESSION["toastMessages"]);
                                    $toastMessages = array(
                                        "code_green",
                                        "Data $tbTxtref($partname) saved :)"
                                    );
                                    processIt($tbPgref, $toastMessages);
                                } else {
                                    ////    TOAST MSG: FAILED to CONV id_stockbarang to partname
                                    unset($_SESSION["toastMessages"]);
                                    $toastMessages = array(
                                        "code_yellow",
                                        "Queries failed to modify data :("
                                    );
                                    processIt($tbPgref, $toastMessages);
                                    //
                                }
                            } else {
                                ////    TOAST MSG: Failed to create temp table for subtraction
                                unset($_SESSION["toastMessages"]);
                                $toastMessages = array(
                                    "code_red",
                                    "Failed to create temp table for subtraction :("
                                );
                                processIt($tbPgref, $toastMessages);
                                //
                            }
                            //
                        } else {
                            ////    TOAST MSG: FAILED to CONV id_stockbarang to partname
                            unset($_SESSION["toastMessages"]);
                            $toastMessages = array(
                                "code_red",
                                "Failed to convert id_stockbarang to partname :("
                            );
                            processIt($tbPgref, $toastMessages);
                            //
                        }
                    } else {
                        ////     TOAST MSG: CHECK tb_stok availability
                        unset($_SESSION["toastMessages"]);
                        $toastMessages = array(
                            "code_red",
                            "There's no stock available on TableStock!"
                        );
                        processIt($tbPgref, $toastMessages);
                        //
                    }
                    ///////
                } else {
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_yellow",
                        "Plz fill Date field before saving :("
                    );
                    processIt($tbPgref, $toastMessages);
                }
            } else {
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_yellow",
                    "Plz fill PIC field before saving :("
                );
                processIt($tbPgref, $toastMessages);
            }
        } else {
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_yellow",
                "Plz fill Quantity field before saving :("
            );
            processIt($tbPgref, $toastMessages);
        }
    } else {
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_yellow",
            "Plz fill PartID field before saving :("
        );
        processIt($tbPgref, $toastMessages);
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////






// <!-- QUERY DEL OUTCOMMING GOODS -->
if (isset($_GET['brout_id']) && !empty($_GET['brout_id']) && isset($_GET['return_qty']) && !empty($_GET['return_qty'])) {
    $tbPgref = 'mg_out.php';
    $tbTxtref = 'OutcomingGoods';

    $brout_id = $_GET['brout_id'];
    $returned_qty = $_GET['return_qty'];


    ////    CONVERT id_stockbarang to partname (DOWN)
    $IDIncomming2PARTNAME = mysqli_query(
        $conn,
        "SELECT tb_br_out.id_brout, tb_br_out.id_stockbarang, tb_stok.namapart, 
        tb_stok.id_stockbarang AS REF_OUTPUT
        FROM tb_br_out
        INNER JOIN tb_pegawai ON tb_br_out.NIK = tb_pegawai.NIK
        INNER JOIN tb_stok ON tb_br_out.id_stockbarang = tb_stok.id_stockbarang
        WHERE tb_br_out.id_brout = '$brout_id';
        "
    );
    ////    CONVERT id_stockbarang to partname (UP)
    $getIncommingData = mysqli_fetch_all($IDIncomming2PARTNAME, MYSQLI_ASSOC);
    $getGoodStockId = $getIncommingData[0]['REF_OUTPUT'];

    if (!empty($getGoodStockId)) {
        $deleteQuery = "DELETE FROM tb_br_out WHERE id_brout = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $brout_id);
        if ($stmt->execute()) {

            // var_dump($getGoodStockId);
            $updateQuery = mysqli_query($conn, "UPDATE tb_stok
                SET tb_stok.jmlh_ttl = tb_stok.jmlh_ttl + $returned_qty
                WHERE tb_stok.id_stockbarang = '$getGoodStockId'");
            if ($updateQuery) {
                $affectedRows = mysqli_affected_rows($conn);
                if ($affectedRows > 0) {
                    // echo "Update query executed successfully. $affectedRows row(s) affected.";
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_green",
                        "$tbTxtref($brout_id) successfully deleted :)"
                    );
                    processIt($tbPgref, $toastMessages);
                } else {
                    // echo "Update query executed successfully, but no rows were affected.";
                    unset($_SESSION["toastMessages"]);
                    $toastMessages = array(
                        "code_yellow",
                        "$tbTxtref($brout_id) failed to delete :("
                    );
                    processIt($tbPgref, $toastMessages);
                }
            } else {
                // echo "Error executing the update query: " . mysqli_error($conn);
                unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_red",
                    "Err: Failed to update tb_stok.jmlh_ttl >" . mysqli_error($conn)
                );
                processIt($tbPgref, $toastMessages);
            }
        } else {
            // echo "Error deleting Outcoming Record: " . mysqli_error($conn);
            unset($_SESSION["toastMessages"]);
            $toastMessages = array(
                "code_red",
                "Err: Failed to delete Data $tbTxtref($brout_id) >" . mysqli_error($conn)
            );
            processIt($tbPgref, $toastMessages);
        }
    } else {
        // Handle the case when no rows are returned
        ////    TOAST MSG: FAILED to CONV id_stockbarang to partname
        unset($_SESSION["toastMessages"]);
        $toastMessages = array(
            "code_red",
            "Failed to convert id_stockbarang to partname. id_stockbarang not found :("
        );
        processIt($tbPgref, $toastMessages);
        //
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