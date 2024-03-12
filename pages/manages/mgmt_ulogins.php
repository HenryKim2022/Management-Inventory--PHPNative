<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user-x"></i></div>
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
                        <button class="btn btn-menutable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal"
                            data-bs-target="#addULoginModal"><i data-feather="plus"></i>
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
                        <th>NIK</th>
                        <th>Fullname</th>
                        <th>Password</th>
                        <th>AccLevel</th>
                        <th>Status</th>
                        <th>Exp D/T</th>
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
                        "SELECT tb_login.password, tb_login.login_status, tb_login.berlaku_sdtgl, 
                        tb_login.created_at, tb_login.updated_at, tb_pegawai.NIK, tb_pegawai.nama_dpn, 
                        tb_pegawai.nama_blk, tb_level.user_level                        
                        FROM tb_login
                        INNER JOIN tb_pegawai ON tb_login.NIK = tb_pegawai.NIK
                        INNER JOIN tb_level ON tb_login.user_level = tb_level.user_level;
                        "
                    );
                    $showtotable = $cekdb;
                    ?>

                    <?php $i = 1;
                    $curr_loggedinNIK = $_SESSION['loggedin_nik'];

                    while ($res = mysqli_fetch_assoc($showtotable)) :  ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $res['NIK'] ?></td>
                        <td>
                            <?php
                                $ulog_fullname = "";
                                if ($res['nama_blk'] == '') :
                                    $ulog_fullname =  $res['nama_dpn'];
                                elseif ($res['nama_blk'] != '') :
                                    $ulog_fullname =  $res['nama_dpn'] . $res['nama_blk'];
                                endif;
                                ?>
                            <?= $ulog_fullname ?>
                        </td>
                        <td><?= $res['password'] ?></td>
                        <td><?= $res['user_level'] ?></td>
                        <td><?= $res['login_status'] ?></td>
                        <td><?= $res['berlaku_sdtgl'] ?></td>
                        <td class="align-middle align-content-sm-between justify-content-center">
                            <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                <a id="<?= $res['NIK'] ?>" data-bs-toggle="modal" data-bs-target="#editUserLoginModal"
                                    onclick="tfIDULOG(event, this.id)"
                                    class="view_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                    <i class="fi-ic-yellow" data-feather="edit"></i>
                                </a>

                                <!-- V2 -->
                                <?php $modal_act_url = "/fungsi/ulogins_funct.php?act=del&unik=" . $res['NIK']; ?>
                                <a name="btnDelSelectedDiv"
                                    href="<?php echo ($res['NIK'] !== $curr_loggedinNIK) ? $modal_act_url : 'javascript:void(0)'; ?>"
                                    class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    <?php if ($res['NIK'] !== $curr_loggedinNIK) { ?>
                                    onclick="return confirm('Are you sure you want to delete *<?= $tbTxtref ?>(<?= $ulog_fullname ?>)?')"
                                    <?php } else { ?> onclick="showConfirmationModal(function(confirm) {
                                        if (confirm) {
                                            // Actions to perform if the user confirms
                                            deleteFunction('<?= $modal_act_url ?>');
                                        } else {
                                            // Actions to perform if the user cancels
                                        }
                                    }); return false;" <?php } ?>>
                                    <i class="fi-ic-red" data-feather="trash-2"></i>
                                </a>

                                <!-- V1 -->
                                <!-- <a name="btnDelSelectedDiv"
                                    href="/fungsi/ulogins_funct.php?act=del&unik=?= $res['NIK'] ?>"
                                    class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    onclick="return confirm('Are you sure want to delete *?= $tbTxtref ?>(?= $ulog_fullname ?>) ?')">
                                    <i class="fi-ic-red" data-feather="trash-2"></i>
                                </a> -->
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



    <script>
    function tfIDULOG(event, id) {
        event.preventDefault();
        $.ajax({
            url: 'layouts/f_wrapper.php',
            method: 'post',
            data: {
                idtoedit: id,
                action: "EDIT",
                which: "USERLOGIN"
            },
            success: function(data) {
                $('#datatoedit').html(data)
                $('#editUserLoginModal').modal('show');
            }
        })
    }
    </script>

</div>







<!-- Modal Add Division -->
<div class="modal fade" id="addULoginModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add UserLogin</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
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
                        $cekdb = mysqli_query($conn, "SELECT NIK, nama_dpn, nama_blk FROM tb_pegawai");
                        $showtotable = $cekdb;
                        ?>
                        <div class="col-8 pr-0 mr-0">
                            <select id="addUserLoginNum" name="addUserLoginNum" class="form-control choices-single-1"
                                onfocus="this.setAttribute('autocomplete', 'off');" autofocus>
                                <option value=""></option>
                                <?php while ($res = mysqli_fetch_assoc($showtotable)) : ?>
                                <option value="<?= $res['NIK'] ?>">
                                    <?php
                                        if ($res['nama_blk'] != '') {
                                            echo '[' . $res['NIK'] . '] ' . $res['nama_dpn'] . ' ' . $res['nama_blk'];
                                        } else {
                                            echo '[' . $res['NIK'] . '] ' . $res['nama_dpn'];
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
                        <input name="addUserLoginPass" type="password" class="form-control col-sm-4"
                            placeholder="Login Password" autocomplete="new-password">
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
                            <select id="addUserLoginLevel" name="addUserLoginLevel"
                                class="form-control choices-single-2"
                                onfocus="this.setAttribute('autocomplete', 'off');" autofocus>
                                <option value=""></option>
                                <?php foreach ($options as $option) : ?>
                                <option value="<?= $option ?>">
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
                            <select id="addUserLoginStatus" name="addUserLoginStatus" onchange="toggleAddExpDate()"
                                onfocus="this.setAttribute('autocomplete', 'off');" class="form-control">
                                <option></option>
                                <option value="Allowed" selected>
                                    Allowed
                                </option>
                                <option value="Blocked">
                                    Blocked
                                </option>
                                <option value="Limited">
                                    Limited by Date
                                </option>
                            </select>

                        </div>
                    </div>

                    <div class="input-group mb-3" id="addExpDateContainer">
                        <div class="input-group-prepend col-md-4">
                            <span class="input-group-text border-0">Date</span>
                        </div>
                        <input name="addUserLoginExpDate" id="addUserLoginExpDate" type="date"
                            class="form-control col-sm-4" placeholder="Date" disabled>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btnAddNewULogin">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>






<!-- Modal Edit Employee -->
<div class="modal fade" id="editUserLoginModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit UserLogin</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="datatoedit">
                <!-- Modal Body Content at f_wrapper -->
            </div>
            <!-- Footer at f_wrapper -->

        </div>
    </div>
</div>





<?php require_once(__DIR__ . '/../../modals/user_confirm_modal.php') ?>