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
                        <button class="btn btn-menutable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal"
                            data-bs-target="#addEmployeeModal">
                            <i data-feather="plus"></i>
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
                        <th>Residential Addr</th>
                        <th>Division</th>
                        <th>Created At</th>
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
                        "SELECT tb_pegawai.NIK, tb_pegawai.nama_dpn, tb_pegawai.nama_blk, 
                        tb_pegawai.alamat_dom, tb_pegawai.created_at, tb_pegawai.updated_at,
                        tb_divisi.id_divisi, tb_divisi.nama_div
                        FROM tb_pegawai
                        INNER JOIN tb_divisi ON tb_pegawai.id_divisi = tb_divisi.id_divisi;
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
                        <td class="text-wrap">
                            <?php
                                $emp_fullname = "";
                                if ($res['nama_blk'] == '') :
                                    $emp_fullname =  $res['nama_dpn'];
                                elseif ($res['nama_blk'] != '') :
                                    $emp_fullname =  $res['nama_dpn'] . ' ' . $res['nama_blk'];
                                endif;
                                ?>
                            <?= $emp_fullname ?>
                        </td>
                        <td><?= $res['alamat_dom'] ?></td>
                        <td><?= $res['nama_div'] ?></td>
                        <td><?= $res['created_at'] ?></td>
                        <td><?= $res['updated_at'] ?></td>
                        <td class="align-middle align-content-sm-between justify-content-center">
                            <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                <a id="<?= $res['NIK'] ?>" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"
                                    onclick="tfIDEMP(event, this.id)"
                                    class="view_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                    <i class="fi-ic-yellow" data-feather="edit"></i>
                                </a>


                                <!-- V2 -->
                                <?php $modal_act_url = "/fungsi/empl_funct.php?act=del&empnik=" . $res['NIK']; ?>
                                <a name="btnDelSelectedEmpl"
                                    href="<?php echo ($res['NIK'] !== $curr_loggedinNIK) ? $modal_act_url : 'javascript:void(0)'; ?>"
                                    class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    <?php if ($res['NIK'] !== $curr_loggedinNIK) { ?>
                                    onclick="return confirm('Are you sure you want to delete *<?= $tbTxtref ?>(<?= $emp_fullname ?>)?')"
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
                                <!-- <a name="btnDelSelectedEmpl"
                                    href="/fungsi/empl_funct.php?act=del&empnik=?= $res['NIK'] ?>"
                                    class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    onclick="return confirm('Are you sure want to delete *?= $tbTxtref ?>(?= $emp_fullname ?>) ?')">
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
    function tfIDEMP(event, id) {
        event.preventDefault();
        $.ajax({
            url: 'layouts/f_wrapper.php',
            method: 'post',
            data: {
                idtoedit: id,
                action: "EDIT",
                which: "EMPLOYEE"
            },
            success: function(data) {
                $('#datatoedit').html(data)
                $('#editEmployeeModal').modal('show');
            }
        })
    }
    </script>



</div>




<!-- Modal Add Employee -->
<div class="modal fade" id="addEmployeeModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Employee</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                <!-- <div class="nav-link-icon"><i data-feather="slack"></i></div> -->
            </div>
            <form method="post" action="/fungsi/empl_funct.php">
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend col-md-4">
                            <span class="input-group-text border-0">NIK</span>
                        </div>
                        <input name="addEmployeeID" type="text" class="form-control col-sm-4" placeholder="e.g. 12345"
                            value="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend col-md-4">
                            <span class="input-group-text border-0">Frist name</span>
                        </div>
                        <input name="addEmployeeFName" type="text" class="form-control col-sm-4" placeholder="e.g. Ir."
                            value="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend col-md-4">
                            <span class="input-group-text border-0">Last name</span>
                        </div>
                        <input name="addEmployeeLName" type="text" class="form-control col-sm-4"
                            placeholder="e.g. Madan" value="">
                    </div>


                    <!-- <div class="input-group mb-3 justify-content-between align-items-start">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">
                                Residential Addr</span>
                        </div>
                        <div class="col-8 pr-0 mr-0">
                            <input type="text" id="addEmployeeDomAddr" name="addEmployeeDomAddr"
                                class="form-control choices-single-11" autocomplete="off" />

                        </div>
                    </div> -->

                    <!-- <div class="input-group mb-3 justify-content-between align-items-start">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">Residential Addr</span>
                        </div>
                        ?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $cekdb = mysqli_query(
                            $conn,
                            "SELECT tb_pegawai.alamat_dom
                                    FROM tb_pegawai"
                        );
                        $showtotable = $cekdb;
                        ?>
                        <div class="col-8 pr-0 mr-0">
                            <input type="text" id="addEmployeeDomAddr" name="addEmployeeDomAddr"
                                class="form-control choices-single-11" autocomplete="off" />
                        </div>
                    </div> -->


                    <!-- SELECT2/ CHOICE FOR INPUT V1 -->
                    <!-- <div class="input-group mb-3 justify-content-between align-items-start">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">Residential Addr</span>
                        </div>
                        <div class="col-8 pr-0 mr-0">
                            <input type="text" id="addEmployeeDomAddr" name="addEmployeeDomAddr" class="form-control"
                            placeholder="e.g. JL. Jendral Sudirman No.1">
                        </div>
                    </div> -->



                    <!-- SELECT2/ CHOICE FOR INPUT V2 -->
                    <div class="input-group mb-3 justify-content-between align-items-sm-center">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">Residential Addr 2</span>
                        </div>

                        <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $cekdb = mysqli_query(
                            $conn,
                            "SELECT tb_pegawai.alamat_dom
                                FROM tb_pegawai
                            "
                        );
                        $showtotable = $cekdb;
                        ?>
                        <div class="col-8 pr-0 mr-0">
                            <select id="addEmployeeDomAddr" class="custom-tom-select" name="addEmployeeDomAddr"
                                data-placeholder="Input Address..." autocomplete="off">
                                <option value="">&#8203;</option>
                                <?php while ($res3 = mysqli_fetch_assoc($showtotable)) : ?>
                                <option value="<?= $res3['alamat_dom'] ?>">
                                    <?= $res3['alamat_dom'] ?>
                                </option>
                                <?php endwhile; ?>
                                <option disabled>Type addr > click enter (Other)</option>
                            </select>
                        </div>
                    </div>

                    <script>
                    new TomSelect("#addEmployeeDomAddr", {
                        allowEmptyOption: true,
                        create: true
                    });

                    new TomSelect("#select-beast-single-disabled", {
                        create: true,
                        sortField: {
                            field: "text"
                        }
                    });
                    </script>

                    <!-- SELECT2/ CHOICE FOR SELECT -->
                    <!-- <div class="input-group mb-3 justify-content-between align-items-start">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">
                                Residential Addr</span>
                        </div>
                        <div class="col-8 pr-0 mr-0">
                            <select id="addEmployeeDomAddr" name="addEmployeeDomAddr"
                                class="form-control choices-single-11">
                                <option></option>

                            </select>
                        </div>
                    </div> -->

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
                            <select id="addEmployeeIntoDiv" name="addEmployeeIntoDiv"
                                class="form-control choices-single-1">
                                <option value=""></option>
                                <?php $i = 1;
                                while ($res = mysqli_fetch_assoc($showtotable)) : ?>
                                <option value="<?= $res['id_divisi'] ?>">
                                    <?php
                                        if ($res['nama_div']  != '') :
                                            echo $res['nama_div'];
                                        endif; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <!-- <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button class="btn btn-primary" type="button">Understood</button> -->
                    <button type="submit" class="btn btn-primary" name="btnAddNewEmployee">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>




<!-- Modal Edit Employee -->
<div class="modal fade" id="editEmployeeModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Employee</h5>
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