<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="users"></i></div>
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
                        <button class="btn btn-menutable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal" data-bs-target="#addUserLevelModal">
                            <i data-feather="plus"></i>
                            ADD
                        </button>
                    </div>

                </div>
                <div class="dropdown no-caret">
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon" data-widget="fullscreen" id="areaChartDropdownExample0" role="button" aria-haspopup="true" aria-expanded="false" onclick="fullscreenFunct()"><i class="fas fa-expand-arrows-alt text-gray-500"></i></i></button>
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon dropdown-toggle d-none" id="areaChartDropdownExample1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample1">
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
                        <th>Level Name</th>
                        <th>Created At</th>
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
                        "SELECT tb_level.user_level, tb_level.created_at
                            FROM tb_level
                        "
                    );
                    $showtotable = $cekdb;
                    ?>
                    <?php $i = 1;
                    while ($res = mysqli_fetch_assoc($showtotable)) :  ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <!-- <td>?= $res['id_divisi'] ?></td> -->
                            <td><?= $res['user_level'] ?></td>
                            <td><?= $res['created_at'] ?></td>
                            <td class="align-middle align-content-sm-between justify-content-center">
                                <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                    <a id="<?= $res['user_level'] ?>" data-bs-toggle="modal" data-bs-target="#editDivisionModal" onclick="tfIDULEV(event, this.id)" class="view_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fi-ic-yellow" data-feather="edit"></i>
                                    </a>
                                    <a name="btnDelSelectedDiv" href="/fungsi/ulevels_funct.php?act=del&usrname=<?= $res['user_level'] ?>" class="btn btn-datatable btn-icon btn-transparent-dark me-2" onclick="return confirm('Are you sure want to delete *<?= $tbTxtref ?>(<?= $res['user_level'] ?>) ?')">
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


    <!-- ?php include_once('layouts/js_bundle.php') ?> -->
    <script>
        function tfIDULEV(event, id) {
            event.preventDefault();
            $.ajax({
                url: 'layouts/f_wrapper.php',
                method: 'post',
                data: {
                    idtoedit: id,
                    action: "EDIT",
                    which: "LEVELUSER"
                },
                success: function(data) {
                    $('#datatoedit').html(data)
                    $('#editUserLevelModal').modal('show');
                }
            })
        }
    </script>


    <div class="card card-icon mb-4 d-none">
        <div class="row g-0">
            <div class="col-auto card-icon-aside bg-primary"><i class="me-1 text-white-50" data-feather="alert-triangle"></i></div>
            <div class="col">
                <div class="card-body py-5">
                    <h5 class="card-title">Third-Party Documentation Available</h5>
                    <p class="card-text">Simple DataTables is a third party plugin that is used to generate the demo
                        table above. For more information about how to use Simple DataTables with your project, please
                        visit the official documentation.</p>
                    <a class="btn btn-primary btn-sm" href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">
                        <i class="me-1" data-feather="external-link"></i>
                        Visit Simple DataTables Docs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Modal Add User Level -->
<div class="modal fade" id="addUserLevelModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add User Level</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="/fungsi/ulevels_funct.php">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text" id="">UserLevel Name</span>
                        </div>
                        <input id="addUlevName" name="addUlevName" type="text" class="form-control" placeholder="e.g. Guest">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btnAddNewUlev">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>




<!-- Modal Edit Division -->
<div class="modal fade" id="editDivisionModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit UserLevel</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="datatoedit">
                <!-- Modal Body Content at f_wrapper -->
            </div>
            <!-- Footer at f_wrapper -->

        </div>
    </div>
</div>






<!-- QUERY ADD USERLEVEL -->
<?php
require('fungsi/koneksi.php');
if (isset($_POST['btnAddNewUlev'])) {

    $nama_id = $_POST['addUlevName'];
    $check = mysqli_query(
        $conn,
        "SELECT * FROM tb_level WHERE user_level = '$nama_id';"
    );

    // If there is a record, display an alert 
    if (mysqli_num_rows($check) > 0) {
        echo "<script> window.onload = function() {
            alert('Data $tbTxtref($nama_id) already exists!');
            window.location.href = '$tbPgref';
        }</script>";
    } else {
        // If there is no record, add it to the database 
        $result = mysqli_query(
            $conn,
            "INSERT INTO tb_level(user_level)
                    VALUES ('$nama_id');"
        );
        if (mysqli_affected_rows($conn) > 0) {
            // if ($result) {
            echo "<script> window.onload = function() {
                alert('Data $tbTxtref($nama_id) added successfully :)');
                window.location.href = '$tbPgref';
            }</script>";
        } else {
            echo "<script> window.onload = function() {
                alert('Err: Failed to add Data $tbTxtref($nama_id) :(');
                window.location.href = '$tbPgref';
            }</script>";
        }
    }
}
?>


<!-- QUERY DEL USERLEVEL -->
<?php
require('fungsi/koneksi.php');
// Menambahkan Barang Masuk
// if (isset($_GET['btnDelSelectedDiv'])) {
// if (isset($_GET['usrname']) and $_GET['usrname'] != "") {
if (isset($_GET['usrname'])) {
    $nama_id = $_GET['usrname'];
    $check = mysqli_query(
        $conn,
        "SELECT * FROM tb_level WHERE user_level = '$nama_id';"
    );

    // If there is a record, display an alert 
    if (mysqli_num_rows($check) > 0) {
        // If there is record, del ir from the database 
        $result = mysqli_query(
            $conn,
            "DELETE FROM tb_level
                WHERE user_level = '$nama_id';"
        );
        if (mysqli_affected_rows($conn) > 0) {
            // if ($result) {
            echo "<script> window.onload = function() {
                alert('Data $tbTxtref($nama_id) delete successfully :)');
                window.location.href = '$tbPgref';
            }</script>";
        } else {
            echo "<script> window.onload = function() {
                alert('Failed to delete data $tbTxtref($nama_id) :(');
                window.location.href = '$tbPgref';
            }</script>";
        }
    } else {
        echo "<script> window.onload = function() {
            alert('Data $tbTxtref($nama_id) not found!');
            window.location.href = '$tbPgref';
        }</script>";
    }
}
