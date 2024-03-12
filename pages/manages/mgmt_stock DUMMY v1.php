<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="package"></i></div>
                        MANAGE
                    </h1>
                    <div class="page-header-subtitle"><?= $pg_title ?></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <!-- Example DataTable for Dashboard Demo-->
    <div id="media_wrapper" class="card mb-4 editor-preview-full">
        <!-- <div class="card card-header-actions h-100"> -->
        <div class="card card-header-actions d-flex card-scroll">
            <div class="card-header">
                <div class="row">
                    <div class="col-auto m-0">
                        <button class="btn btn-menutable btn-icon btn-transparent-dark me-2" href="javascript:void(0);"
                            data-bs-toggle="modal" data-bs-target="#addGoodsStockModal"><i data-feather="plus"></i>
                            ADD
                        </button>
                    </div>

                </div>
                <div class="dropdown no-caret">
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon" data-widget="fullscreen"
                        id="areaChartDropdownExample0" role="button" aria-haspopup="true" aria-expanded="false"
                        onclick="fullscreenFunct()"><i class="fas fa-expand-arrows-alt text-gray-500"></i></i></button>
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon dropdown-toggle d-none"
                        id="areaChartDropdownExample1" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                        aria-labelledby="areaChartDropdownExample1">
                        <a class="dropdown-item" href="#!">Last 12 Months</a>
                        <a class="dropdown-item" href="#!">Last 30 Days</a>
                        <a class="dropdown-item" href="#!">Last 7 Days</a>
                        <a class="dropdown-item" href="#!">This Month</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Custom Range</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive-sm overflow-auto">
            <table id="datatablesSimple" cellspacing="0" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Part Name</th>
                        <th>Qty</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr></tr>
                </tfoot>
                <tbody>
                    <?php
                    if (session_status() == PHP_SESSION_NONE) : {
                            session_start();
                        }
                    endif;
                    $cekdb = mysqli_query(
                        $conn,
                        "SELECT tb_stok.id_stockbarang, tb_stok.jmlh_ttl, tb_stok.id_part, tb_stok.created_at, tb_stok.updated_at, tb_part.namapart
                        FROM tb_stok
                        INNER JOIN tb_part ON tb_stok.id_part = tb_part.id_part;
                        "
                    );
                    $showtotable = $cekdb;
                    ?>

                    <?php $i = 1;
                    while ($res = mysqli_fetch_assoc($showtotable)) :  ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $res['namapart'] ?></td>
                        <td><?= $res['jmlh_ttl'] ?></td>
                        <td><?= $res['updated_at'] ?></td>
                        <td class="align-middle align-content-sm-between justify-content-center">
                            <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                <a id="<?= $res['namapart'] ?>" data-bs-toggle="modal" data-bs-target="#editStockModal"
                                    onclick="tfIDSTG(event, this.id)"
                                    class="view_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                    <i class="fi-ic-yellow" data-feather="edit"></i>
                                </a>
                                <a name="btnDelSelectedDiv"
                                    href="<?= $tbPgref ?>?act=del&usrname=<?= $res['namapart'] ?>"
                                    class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    onclick="return confirm('Are you sure want to delete *<?= $tbTxtref ?>(<?= $res['namapart'] ?>) ?')">
                                    <i class="fi-ic-red" data-feather="trash-2"></i>
                                </a>
                                <a href="#" class="show_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                    <i class="fi-ic-gray" data-feather="info"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>







<!-- Modal Add Goods Stocks -->
<div class="modal fade" id="addGoodsStockModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Goods/Stocks</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                <!-- <div class="nav-link-icon"><i data-feather="slack"></i></div> -->
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="input-group mb-3 justify-content-between align-items-start">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">
                                Part ID</span>
                        </div>
                        <?php
                        if (session_status() == PHP_SESSION_NONE) : {
                                session_start();
                            }
                        endif;
                        $cekdb = mysqli_query(
                            $conn,
                            "SELECT tb_part.id_part, tb_part.namapart
                                FROM tb_part
                            "
                        );
                        $showtotable = $cekdb;
                        ?>
                        <div class="col-8 pr-0 mr-0">
                            <select id="addStockPartID" name="addStockPartID" class="form-control choices-single-1">
                                <option></option>
                                <?php $i = 1;
                                while ($res = mysqli_fetch_assoc($showtotable)) : ?>
                                <option value="<?= $res['id_part'] ?>">
                                    <?= $res['namapart'] ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend col-md-4">
                            <span class="input-group-text border-0">Quantity</span>
                        </div>
                        <input name="qtyStockIn" type="number" class="form-control col-sm-4" placeholder="Qty"
                            value="1">
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button class="btn btn-primary" type="button">Understood</button> -->
                    <button type="submit" class="btn btn-primary" name="btnAddNewStock">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>






<!-- QUERY ADD DIV -->
<?php
require('fungsi/koneksi.php');
// require('layouts/set_title.php');

if (isset($_POST['btnAddNewStock'])) {
    $nama_id = $_POST['addStockPartID'];
    $qty = $_POST['qtyStockIn'];

    $check = mysqli_query(
        $conn,
        "SELECT * 
            FROM tb_stok 
            WHERE id_part = '$nama_id';"
    );

    ///////// If there is a record, display an alert 
    if (mysqli_num_rows($check) > 0) {
        if (isset(($_SESSION["toastMessages"]))) {
            //unset($_SESSION["toastMessages"]);
            if (session_status() == PHP_SESSION_NONE) {
                session_start(); // Jika belum dimulai, mulai sesi
                $_SESSION['toastMessages'][0] = "code_yellow";
                $_SESSION['toastMessages'][1] = "Data $tbTxtref($nama_id) already exists!";
                //#/ echo "<script> window.location.href = '$tbPgref';</script>";
                echo "<script> window.onload = function() {
                    window.location.href = '$tbPgref';
                }</script>";
            }
            $_SESSION['toastMessages'][0] = "code_yellow";
            $_SESSION['toastMessages'][1] = "Data $tbTxtref($nama_id) already exists!";
            echo "<script> window.onload = function() {
                window.location.href = '$tbPgref';
            }</script>";
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                $_SESSION['toastMessages'][0] = "code_yellow";
                session_start(); // Jika belum dimulai, mulai sesi
                $_SESSION['toastMessages'][1] = "Data $tbTxtref($nama_id) already exists!";
                echo "<script> window.onload = function() {
                    window.location.href = '$tbPgref';
                }</script>";
            }
            $_SESSION['toastMessages'][0] = "code_yellow";
            $_SESSION['toastMessages'][1] = "Data $tbTxtref($nama_id) already exists!";
            echo "<script> window.onload = function() {
                window.location.href = '$tbPgref';
            }</script>";
        }
        ///////
    } else { // If there is no record, add it to the database 
        $result = mysqli_query(
            $conn,
            "INSERT INTO tb_stok(jmlh_ttl, id_part)
                VALUES ('$qty','$nama_id');"
        );
        if (mysqli_affected_rows($conn) > 0) {
            if (isset(($_SESSION["toastMessages"]))) {
                //unset($_SESSION["toastMessages"]);
                $toastMessages = array(
                    "code_green",
                    "1.1 > Data $tbTxtref($nama_id) added successfully :)"
                );

                $result = setSessionValuesAndRedirect($tbPgref, $toastMessages);
                if ($result === true) {
                    // echo "<script>
                    // console.log('Session values set successfully');
                    // </script>";
                    $baseUrl = $_SERVER['HTTP_HOST'] . '/';
                    $desiredPath = $tbPgref;
                    $redirectUrl = $baseUrl . $desiredPath;
                    echo "<script>console.log('$redirectUrl');
                    window.location.href = '$redirectUrl';</script>";
                } elseif ($result === false) {
                    echo "<script>
                        console.log('Invalid Data Yanto');
                        </script>";
                }
            }
        } else {
            //unset($_SESSION["toastMessages"]);
            if (isset(($_SESSION["toastMessages"]))) {
                //unset($_SESSION["toastMessages"]);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); // Jika belum dimulai, mulai sesi
                    $_SESSION['toastMessages'][0] = "code_red";
                    $_SESSION['toastMessages'][1] = "Err: Failed to add Data $tbTxtref($nama_id) :(";
                    echo "<script> window.onload = function() {
                        window.location.href = '$tbPgref';
                    }</script>";
                }
                $_SESSION['toastMessages'][0] = "code_red";
                $_SESSION['toastMessages'][1] = "Err: Failed to add Data $tbTxtref($nama_id) :(";
                echo "<script> window.onload = function() {
                        window.location.href = '$tbPgref';
                    }</script>";
            } else {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); // Jika belum dimulai, mulai sesi
                    $_SESSION['toastMessages'][0] = "code_red";
                    $_SESSION['toastMessages'][1] = "Err: Failed to add Data $tbTxtref($nama_id) :(";
                    echo "<script> window.onload = function() {
                        window.location.href = '$tbPgref';
                    }</script>";
                }
                $_SESSION['toastMessages'][0] = "code_red";
                $_SESSION['toastMessages'][1] = "Err: Failed to add Data $tbTxtref($nama_id) :(";
                echo "<script> window.onload = function() {
                    window.location.href = '$tbPgref';
                }</script>";
            }
        }
    }
}





function processIt($tbPgref, $toastMessages)
{
    $result = setSessionValuesAndRedirect($tbPgref, $toastMessages);
    if ($result === true) {
        // echo "<script>
        // console.log('Session values set successfully');
        // </script>";
        $baseUrl = $_SERVER['HTTP_HOST'] . '/';
        $desiredPath = $tbPgref;
        $redirectUrl = $baseUrl . $desiredPath;
        echo "<script>console.log('$redirectUrl');</script>";
        echo "<script>window.location.href = '$redirectUrl';</script>";
    } elseif ($result === false) {
        echo "<script>
        console.log('Invalid Data Yanto');
        </script>";
    }
}

function setSessionValuesAndRedirect($tbPgref, $toastMessages)
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

    return null;
}


?>