<?php
require_once(__DIR__ . '/../fungsi/koneksi.php');
require_once(__DIR__ . '/../fungsi/converter/datetime.php');
?>

<?php
// DEFINE GLOBAL VAR
$res;
$action = "";
$which = "";


if (isset($_POST['action'])) {
    if ($_POST['action'] == "EDIT") :
        // EDIT DIVISION
        if ($_POST['which'] == "DIVISION") :
            if (isset($_POST['idtoedit'])) :
                $divtoedit = $_POST['idtoedit'];
                $query = "SELECT tb_divisi.id_divisi, tb_divisi.nama_div
            FROM tb_divisi WHERE nama_div='$divtoedit'";
                $exec = mysqli_query($conn, $query);
                $res = mysqli_fetch_assoc($exec);
?>
<form method="post" action="edit_data.php" enctype="multipart/form-data">
    <div class="row">
        <div class="input-group mb-3 d-none">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">Division ID</span>
            </div>
            <input id="editIDDiv" name="editIDDiv" value="<?= $res['id_divisi'] ?>" type="text"
                class="form-control col-lg-4" placeholder="ID Divisi">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">Division Name</span>
            </div>
            <input id="editDivName" name="editDivName" value="<?= $res['nama_div'] ?>" type="text"
                class="form-control col-lg-4" placeholder="e.g. Financial">
        </div>
    </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnEditNewDiv">Save</button>
    </div>

</form>

<script type="text/javascript">
$('#closemodal').click(function() {
    $('#editDivisionModal').modal('hide');
});
</script>

<?php
            endif;




        // EDIT LEVEL USER
        elseif ($_POST['which'] == "LEVELUSER") :
            if (isset($_POST['idtoedit'])) :
                $lvltoedit = $_POST['idtoedit'];
                $query = "SELECT tb_level.user_level, tb_level.created_at
                            FROM tb_level
                            WHERE user_level='$lvltoedit';
                        ";
                $exec = mysqli_query($conn, $query);
                $res = mysqli_fetch_assoc($exec);
            ?>
<form method="post" action="edit_data.php" enctype="multipart/form-data">
    <div class="row">
        <div class="input-group mb-3 d-none">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    LevelUser ID
                </span>
            </div>
            <input id="editIDLevel" name="editIDLevel" value="<?= $res['id_level'] ?>" type="text"
                class="form-control col-lg-4" placeholder="UserLevel ID">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    UserLevel Name
                </span>
            </div>
            <input id="editLevelName" name="editLevelName" value="<?= $res['user_level'] ?>" type="text"
                class="form-control col-lg-4" placeholder="e.g. Guest">
        </div>
    </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnEditNewDiv">Save</button>
    </div>

</form>

<script type="text/javascript">
$('#closemodal').click(function() {
    $('#editUserLevelModal').modal('hide');
});
</script>
<?php
            endif;




        // EDIT PARTS
        elseif ($_POST['which'] == "PART") :
            if (isset($_POST['idtoedit'])) :
                $parttoedit = $_POST['idtoedit'];
                $query = "SELECT tb_part.namapart
                            FROM tb_part WHERE namapart='$parttoedit';
                        ";
                $exec = mysqli_query($conn, $query);
                $res = mysqli_fetch_assoc($exec); ?>

<form method="post" action="edit_data.php" enctype="multipart/form-data">
    <div class="row">
        <div class="input-group mb-3">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    Part Name
                </span>
            </div>
            <input id="editPartName" name="editPartName" value="<?= $res['namapart'] ?>" type="text"
                class="form-control" placeholder="e.g. HD 19504-PLC-OOO">
        </div>
    </div>

    </div>
    <div class="modal-footer">
        <button id="closemodal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="btnEditNewPart">Save</button>
    </div>

</form>

<script type="text/javascript">
$('#closemodal').click(function() {
    $('#editPartModal').modal('hide');

});
</script>



<?php
            endif;




        // EDIT INCOMING
        elseif ($_POST['which'] == "INCOMING") :
            if (isset($_POST['idtoedit'])) :
                $incotoedit = $_POST['idtoedit'];
                $query = "SELECT tb_br_in.id_brin, tb_br_in.tanggal AS TANGGAL, tb_br_in.jmlh AS JUMLAH, tb_br_in.id_stockbarang, 
                        tb_br_in.updated_at, tb_br_in.NIK, tb_stok.namapart
                    FROM tb_br_in
                    INNER JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                    INNER JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                    WHERE tb_br_in.id_brin = '$incotoedit';
                    ";
                $exec = mysqli_query($conn, $query);
                $res1 = mysqli_fetch_assoc($exec); ?>
<form method="post" action="/fungsi/stock_funct.php">
    <div class="modal-body">
        <div class="input-group mb-3 justify-content-between align-items-start">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    Goods PartName</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) : {
                                    session_start();
                                }
                            endif;
                            $cekdb = mysqli_query(
                                $conn,
                                "SELECT tb_stok.id_stockbarang, tb_stok.namapart
                                FROM tb_stok
                            "
                            );
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="addIncomingPartID" name="addIncomingPartID" class="form-control choices-single-8">
                    <option></option>
                    <?php
                                    while ($res2 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res2['id_stockbarang'] == $res1['id_stockbarang']) ? 'selected' : '';
                                    ?>
                    <option value="<?= $res2['id_stockbarang'] ?>" <?= $selected ?>>
                        <?= '[' . $res2['id_stockbarang'] .  '] ' . $res2['namapart'] ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Quantity</span>
            </div>
            <input name="qtyGoodsIn" type="number" class="form-control col-sm-4" placeholder="Qty"
                value="<?= $res1['JUMLAH'] ?>" min="1">
        </div>

        <div class="input-group mb-3 justify-content-between">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0" id="">
                    PIC</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) : {
                                    session_start();
                                }
                            endif;
                            $cekdb = mysqli_query(
                                $conn,
                                "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn, tb_pegawai.nama_blk 
                                FROM tb_pegawai
                            "
                            );
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="AddPICInNum" name="AddPICInNum" class="form-control choices-single-9">
                    <option value=""></option>
                    <?php $i = 1;
                                    while ($res2 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res2['NIK'] == $res1['NIK']) ? 'selected' : '';

                                    ?>
                    <option value="<?= $res2['NIK'] ?>" <?= $selected ?>>
                        <?php
                                            if ($res2['nama_blk']  != '') :
                                                echo '[' . $res2['NIK'] . '] ' . $res2['nama_dpn'] . ' ' . $res2['nama_blk'];
                                            elseif ($res2['nama_blk']  == '') :
                                                echo  '[' . $res2['NIK'] . '] ' . $res2['nama_dpn'];
                                            endif; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Date</span>
            </div>
            <input name="incomingDate" type="date" class="form-control col-sm-4" placeholder="Date"
                value="<?= convertDateToField($res1['TANGGAL']) ?>">
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnAddEditIncoming">Save</button>
    </div>
</form>

<?php
            endif;




        // EDIT OUTCOMING
        elseif ($_POST['which'] == "OUTCOMING") :
            if (isset($_POST['idtoedit'])) :
                $outcotoedit = $_POST['idtoedit'];
                $query = "SELECT tb_br_out.id_brout, tb_br_out.tanggal AS TANGGAL, tb_br_out.jmlh AS JUMLAH, tb_br_out.id_stockbarang, 
                            tb_br_out.updated_at, tb_br_out.NIK, tb_stok.namapart
                            FROM tb_br_out
                            INNER JOIN tb_pegawai ON tb_br_out.NIK = tb_pegawai.NIK
                            INNER JOIN tb_stok ON tb_br_out.id_stockbarang = tb_stok.id_stockbarang
                            WHERE tb_br_out.id_brout = '$outcotoedit';
                        ";
                $exec = mysqli_query($conn, $query);
                $res1 = mysqli_fetch_assoc($exec); ?>

<form method="post" action="/fungsi/stock_funct.php">
    <div class="modal-body row">
        <div class="input-group mb-3 justify-content-between align-items-start col-2">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    Goods PartName</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) : {
                                    session_start();
                                }
                            endif;
                            $cekdb = mysqli_query(
                                $conn,
                                "SELECT tb_stok.id_stockbarang, tb_stok.namapart
                                FROM tb_stok
                            "
                            );
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="addOutcomingPartID" name="addOutcomingPartID" class="form-control choices-single-8">
                    <option></option>
                    <?php
                                    $i = 1;
                                    while ($res2 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res2['id_stockbarang'] == $res1['id_stockbarang']) ? 'selected' : '';
                                    ?>
                    <option value="<?= $res2['id_stockbarang'] ?>" <?= $selected ?>>
                        <?= '[' . $res2['id_stockbarang'] .  '] ' . $res2['namapart'] ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Quantity</span>
            </div>
            <input name="qtyGoodsOut" type="number" class="form-control col-sm-4" placeholder="Qty"
                value="<?= $res1['JUMLAH'] ?>" min="1">
        </div>

        <div class="input-group mb-3 justify-content-between">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0" id="">
                    PIC</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) : {
                                    session_start();
                                }
                            endif;
                            $cekdb = mysqli_query(
                                $conn,
                                "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn, tb_pegawai.nama_blk 
                                FROM tb_pegawai
                            "
                            );
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="AddPICOutNum" name="AddPICOutNum" class="form-control choices-single-9">
                    <option value=""></option>
                    <?php $i = 1;
                                    while ($res3 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res3['NIK'] == $res1['NIK']) ? 'selected' : '';
                                    ?>
                    <option value="<?= $res3['NIK'] ?>" <?= $selected ?>>
                        <?php
                                            if ($res3['nama_blk']  != '') :
                                                echo '[' . $res3['NIK'] . '] ' .  $res3['nama_dpn'] . ' ' . $res3['nama_blk'];
                                            elseif ($res3['nama_blk']  == '') :
                                                echo '[' . $res3['NIK'] . '] ' .  $res3['nama_dpn'];
                                            endif; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Date</span>
            </div>
            <input name="outcomingDate" type="date" class="form-control col-xs-2" placeholder="Date"
                value="<?= convertDateToField($res1['TANGGAL']) ?>">
        </div>

    </div>
    <div class="modal-footer">
        <!-- <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button> -->
        <!-- <button class="btn btn-primary" type="button">Understood</button> -->
        <button type="submit" class="btn btn-primary" name="btnEditOutcoming">Save</button>
    </div>
</form>



<?php
            endif;




        // EDIT STOCKS
        elseif ($_POST['which'] == "STOCK") :
            if (isset($_POST['idtoedit'])) :
                $stcktoedit = $_POST['idtoedit'];
                $query = "SELECT tb_stok.id_stockbarang, tb_stok.jmlh_ttl, tb_stok.namapart AS NAPART1, tb_stok.created_at, tb_stok.updated_at, tb_part.namapart
                            FROM tb_stok
                            INNER JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            WHERE tb_stok.id_stockbarang = '$stcktoedit';
                        ";
                $exec = mysqli_query($conn, $query);
                $res1 = mysqli_fetch_assoc($exec); ?>
<form method="post" action="/fungsi/stock_funct.php">
    <div class="modal-body">
        <div class="input-group mb-3 justify-content-between align-items-start">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    PartName</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) : {
                                    session_start();
                                }
                            endif;
                            $cekdb = mysqli_query(
                                $conn,
                                "SELECT tb_part.namapart AS NAPART2
                                FROM tb_part
                            "
                            );
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="addStockPartID" name="addStockPartID" class="form-control choices-single-7">
                    <option value=""></option>
                    <?php $i = 1;
                                    while ($res2 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res2['NAPART2'] == $res1['NAPART1']) ? 'selected' : '';
                                    ?>

                    <option value="<?= $res2['NAPART2'] ?>" <?= $selected ?>>
                        <?= $res2['NAPART2'] ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="input-group mb-3 d-none">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Quantity</span>
            </div>
            <input name="qtyStockIn" type="number" class="form-control col-sm-4" placeholder="Qty"
                value="<?= $res1['jmlh_ttl'] ?>" max="0" readonly>
        </div>

    </div>
    <div class="modal-footer">
        <!-- <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button> -->
        <!-- <button class="btn btn-primary" type="button">Understood</button> -->
        <button type="submit" class="btn btn-primary" name="btnAddNewStock">Save</button>
    </div>
</form>

<?php
            endif;






        // EDIT EMPLOYEE
        elseif ($_POST['which'] == "EMPLOYEE") :
            if (isset($_POST['idtoedit'])) :
                $empltoedit = $_POST['idtoedit'];
                $query = "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn, tb_pegawai.nama_blk, 
                            tb_pegawai.alamat_dom, tb_pegawai.created_at, tb_pegawai.updated_at,
                            tb_divisi.id_divisi, tb_divisi.nama_div
                            FROM tb_pegawai
                            INNER JOIN tb_divisi ON tb_pegawai.id_divisi = tb_divisi.id_divisi
                            WHERE tb_pegawai.NIK = '$empltoedit';
                        ";
                $exec = mysqli_query($conn, $query);
                $res1 = mysqli_fetch_assoc($exec);
            ?>
<form method="post" action="/fungsi/empl_funct.php">
    <div class="modal-body">

        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">NIK</span>
            </div>
            <input name="addEmployeeID" type="text" class="form-control col-sm-4" placeholder="e.g. 12345"
                value="<?= $res1['NIK'] ?>">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Frist name</span>
            </div>
            <input name="addEmployeeFName" type="text" class="form-control col-sm-4" placeholder="e.g. Ir."
                value="<?= $res1['nama_dpn'] ?>">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Last name</span>
            </div>
            <input name="addEmployeeLName" type="text" class="form-control col-sm-4" placeholder="e.g. Madan"
                value="<?= $res1['nama_blk'] ?>">
        </div>

        <!-- SELECT2/ CHOICE FOR INPUT -->
        <div class="input-group mb-3 justify-content-between align-items-start">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">Residential Addr</span>
            </div>
            <div class="col-8 pr-0 mr-0">
                <input type="text" id="addEmployeeDomAddr" name="addEmployeeDomAddr" class="form-control"
                    placeholder="e.g. JL. Jendral Sudirman No.1" value="<?= $res1['alamat_dom'] ?>">
            </div>
        </div>

        <div class="input-group mb-3 justify-content-between">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0" id="">
                    Division</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) : {
                                    session_start();
                                }
                            endif;
                            $cekdb = mysqli_query(
                                $conn,
                                "SELECT tb_divisi.id_divisi, tb_divisi.nama_div
                                FROM tb_divisi
                            "
                            );
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="addEmployeeIntoDiv" name="addEmployeeIntoDiv" class="form-control choices-single-8">
                    <option value=""></option>
                    <?php $i = 1;
                                    while ($res2 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res2['nama_div'] == $res1['nama_div']) ? 'selected' : '';
                                    ?>
                    <option value="<?= $res2['id_divisi'] ?>" <?= $selected ?>>
                        <?php
                                            if ($res2['nama_div']  != '') :
                                                echo $res2['nama_div'];
                                            endif; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnAddNewEmployee">Save</button>
    </div>
</form>

<?php
            endif;






        // EDIT USERLOGINS
        elseif ($_POST['which'] == "USERLOGIN") :
            if (isset($_POST['idtoedit'])) :
                $ulogtoedit = $_POST['idtoedit'];
                $query = "SELECT tb_login.password, tb_login.login_status, tb_login.berlaku_sdtgl AS EXPDATE, 
                            tb_login.created_at, tb_login.updated_at, tb_pegawai.NIK, tb_pegawai.nama_dpn, 
                            tb_pegawai.nama_blk, tb_level.user_level                        
                            FROM tb_login
                            INNER JOIN tb_pegawai ON tb_login.NIK = tb_pegawai.NIK
                            INNER JOIN tb_level ON tb_login.user_level = tb_level.user_level
                            WHERE tb_pegawai.NIK = '$ulogtoedit';
                        ";
                $exec = mysqli_query($conn, $query);
                $res1 = mysqli_fetch_assoc($exec);
            ?>
<form method="post" action="/fungsi/ulogins_funct.php">
    <div class="modal-body">
        <div class="input-group mb-3 justify-content-between">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0" id="">Employee</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            $cekdb = mysqli_query($conn, "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn, 
                            tb_pegawai.nama_blk FROM tb_pegawai");
                            $showtotable = $cekdb;
                            ?>
            <div class="col-8 pr-0 mr-0">
                <select id="addUserLoginNum" name="addUserLoginNum" class="form-control choices-single-8"
                    onfocus="this.setAttribute('autocomplete', 'off');" autofocus>
                    <option value=""></option>
                    <?php while ($res2 = mysqli_fetch_assoc($showtotable)) :
                                        $selected = ($res2['NIK'] == $res1['NIK']) ? 'selected' : '';
                                    ?>
                    <option value="<?= $res2['NIK'] ?>" <?= $selected ?>>
                        <?php
                                            if ($res2['nama_blk'] != '') {
                                                echo '[' . $res2['NIK'] . '] ' . $res2['nama_dpn'] . ' ' . $res2['nama_blk'];
                                            } else {
                                                echo '[' . $res2['NIK'] . '] ' . $res2['nama_dpn'];
                                            }
                                            ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Password</span>
            </div>
            <input name="addUserLoginPass" type="password" class="form-control col-sm-4" placeholder="Login Password"
                autocomplete="false" value="<?= $res1['password'] ? $res1['password'] : '' ?>">
        </div>



        <div class="input-group mb-3 justify-content-between">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0" id="">
                    UserLevel</span>
            </div>
            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }

                            $cekdb = mysqli_query($conn, "SELECT tb_level.user_level FROM tb_level");
                            $options = array();
                            while ($row = mysqli_fetch_assoc($cekdb)) {
                                $options[] = $row['user_level'];
                            }
                            // Sort the options alphabetically
                            sort($options);
                            $showtotable = $options;
                            ?>

            <div class="col-8 pr-0 mr-0">
                <select id="addUserLoginLevel" name="addUserLoginLevel" class="form-control choices-single-9"
                    onfocus="this.setAttribute('autocomplete', 'off');" autofocus>
                    <option value=""></option>
                    <?php foreach ($options as $option) :
                                        $selected = ($option == $res1['user_level']) ? 'selected' : '';
                                    ?>
                    <option value="<?= $option ?>" <?= $selected ?>>
                        <?php
                                            if ($option != '') {
                                                echo $option;
                                            }
                                            ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <div class="input-group mb-3 justify-content-between align-items-start">
            <div class="input-group-prepend col-sm-4">
                <span class="input-group-text border-0" id="">
                    LoginStatus</span>
            </div>

            <div class="col-8 pr-0 mr-0">
                <select id="editUserLoginStatus" name="editUserLoginStatus" onchange="toggleEditExpDate()"
                    onfocus="this.setAttribute('autocomplete', 'off');" class="form-control">
                    <option></option>
                    <?php
                                    $allowedSelected = ($res1['login_status'] == 'Allowed') ? 'selected' : '';
                                    $blockedSelected = ($res1['login_status'] == 'Blocked') ? 'selected' : '';
                                    $limitedSelected = ($res1['login_status'] == 'Limited') ? 'selected' : '';
                                    ?>
                    <option value="Allowed" <?= $allowedSelected ?>>
                        Allowed
                    </option>
                    <option value="Blocked" <?= $blockedSelected ?>>
                        Blocked
                    </option>
                    <option value="Limited" <?= $limitedSelected ?>>
                        Limited by Date
                    </option>
                </select>

            </div>
        </div>

        <!-- <div class="input-group mb-3" id="editExpDateContainer">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Date</span>
            </div>
            <input name="editUserLoginExpDate" id="editUserLoginExpDate" type="date" class="form-control col-sm-4"
                onload="setEditExpDate(event, this.placeholder)"
                placeholder="?= $res1['EXPDATE'] ? $res1['EXPDATE'] : '' ?>" disabled>
        </div> -->

        <div class="input-group mb-3" id="editExpDateContainer">
            <div class="input-group-prepend col-md-4">
                <span class="input-group-text border-0">Date</span>
            </div>
            <?php
                            $isDisabled = ($res1['login_status'] == 'Limited') ? 'enabled' : 'disabled';
                            ?>
            <input name="editUserLoginExpDate" id="editUserLoginExpDate" type="date" class="form-control col-sm-4"
                value="<?= $res1['EXPDATE'] ? date('Y-m-d', strtotime($res1['EXPDATE'])) : '' ?>" <?= $isDisabled ?>>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnAddNewULogin">Save</button>
    </div>
</form>

<?php
            endif;

        endif;
    // OTHER 
    endif; ?>
<?php }















?>


<script>
var classNames = [
    "choices-single-7", "choices-single-8", "choices-single-9",
    "choices-single-10", "choices-single-11", "choices-single-12"
];

classNames.forEach(function(className) {
    var elements = document.getElementsByClassName(className);

    if (elements.length > 0) {
        new Choices(elements[0], {
            allowHTML: true,
            searchEnabled: true
        });
    }
});
</script>



<script>
function toggleEditExpDate() {
    var statusSelect = document.getElementById("editUserLoginStatus");
    var expDateInput = document.getElementById("editUserLoginExpDate");

    if (statusSelect.value === "Limited") {
        expDateInput.disabled = false;
        expDateInput.value = new Date().toISOString().split("T")[0];
    } else {
        expDateInput.disabled = true;
        expDateInput.value = "";
    }
}
</script>